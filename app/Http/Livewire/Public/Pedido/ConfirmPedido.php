<?php

namespace App\Http\Livewire\Public\Pedido;

use App\Models\Carrito;
use App\Models\CarritoDetalle;
use App\Models\Pagina;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Producto;
use Livewire\Component;

class ConfirmPedido extends Component
{
    public $carrito;
    public $detalles;
    public $pedido;
    public $total;
    public $cantidades;
    public $cantProducts;
    public $mostrarQR = false;
    public $error = false;

    public function mount()
    {
        $this->carrito = Carrito::GetCarrito();
        $this->detalles = CarritoDetalle::GetCarritoDetalles();
        $this->total = $this->carrito->monto_total;
        $this->cantProducts = count($this->detalles);
        foreach ($this->detalles as $detalle) {
            $this->cantidades[$detalle->id] = $detalle->cantidad;
        }
        Pagina::UpdateVisita('public.confirm_pedido');
    }

    public function addCart($id, $cantidad)
    {
        $producto = Producto::GetProducto($id);
        $detalle = CarritoDetalle::CreateCarritoDetalle([
            'cantidad' => $cantidad,
            'producto_id' => $id,
            'carrito_id' => $this->carrito->id,
            'precio' => $producto->precio,
        ]);
        $this->carrito = Carrito::UpdateMontoTotal(
            $this->carrito->monto_total + ($detalle->cantidad * $producto->precio)
        );
        dd($this->carrito->monto_total);
        $this->refresh();
        $this->emit('refresh');
    }

    public function removeCart($id)
    {
        $detalle = CarritoDetalle::DeleteCarritoDetalle($id);
        $this->carrito = Carrito::UpdateMontoTotal($this->carrito->monto_total - ($detalle->cantidad * $detalle->precio));
        $this->refresh();
        $this->emit('refresh');
    }

    public function updateCart($id, $value)
    {
        $this->cantidades[$id] = $this->cantidades[$id] + $value;
        $detalle = CarritoDetalle::UpdateCarritoDetalle($id, [
            'cantidad' => $this->cantidades[$id],
        ]);
        $this->carrito = Carrito::UpdateMontoTotal(
            $this->carrito->monto_total + ($value * $detalle->precio)
        );
        $this->refresh();
        $this->emit('refresh');
    }

    public function refresh()
    {
        $this->reset('detalles', 'total');
        $this->detalles = CarritoDetalle::GetCarritoDetalles();
        $this->total = $this->carrito->monto_total;
    }

    public function confirmPedido()
    {
        $stockValid = CarritoDetalle::ValidStock();
        if ($stockValid) {
            $this->pedido = Pedido::CreatePedido();
            $this->detalles = PedidoDetalle::GetPedidoDetalleByPedido($this->pedido->id);
            $this->mostrarQR = true;
        } else {
            $this->error = true;
        }
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('public.confirm_pedido') ?? 0;
        return view('livewire.public.pedido.confirm-pedido', compact('visitas'))->layout('layouts.public', ['fondo' => false]);
    }
}
