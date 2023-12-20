<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    use HasFactory;
    protected $fillable = [
        "cantidad",
        "precio",
        "pedido_id",
        "producto_id",
    ];
    protected $table = 'pedido_detalle';

    // Asociaciones

    // Funciones
    static public function GetPedidoDetalle(int $id)
    {
        return PedidoDetalle::where('id', $id)->First();
    }

    static public function GetPedidoDetalleByPedido(int $id)
    {
        return PedidoDetalle::where('pedido_id', $id)->get();
    }

    static public function crearPedidoDetalle(int $id)
    {
        $detalles = CarritoDetalle::GetCarritoDetalles();
        foreach ($detalles as $detalle) {
            PedidoDetalle::create([
                'cantidad' => $detalle->cantidad,
                'precio' => $detalle->precio,
                'pedido_id' => $id,
                'producto_id' => $detalle->producto_id,
            ]);
            Producto::updateStock($detalle->producto_id, -$detalle->cantidad);
        }
    }
}
