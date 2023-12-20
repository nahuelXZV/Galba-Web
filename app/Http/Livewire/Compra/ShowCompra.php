<?php

namespace App\Http\Livewire\Compra;

use Livewire\Component;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\CompraDetalle;

class ShowCompra extends Component
{
    public $compra;
    public $detalles;
    public $proveedor;

    public function mount($id)
    {
        $this->compra = Compra::GetCompra($id);
        $this->proveedor = Proveedor::GetProveedor($this->compra->proveedor_id);
        $this->detalles = CompraDetalle::GetCompraDetallesByIdCompra($id);
    }

    public function detalle($id){
        return redirect()->route('compra-detalle.new', $id);
    }

    public function render()
    {
        return view('livewire.compra.show-compra');
    }
}
