<?php

namespace App\Http\Livewire\Public\Producto;

use App\Models\Producto;
use Livewire\Component;

class ShowProduct extends Component
{
    public $producto;

    public function mount($id)
    {
        $this->producto = Producto::GetProducto($id);
    }

    function addCart($id)
    {
        $this->emit('addCart', $id, 1);
    }

    public function render()
    {
        return view('livewire.public.producto.show-product')->layout('layouts.public', ['fondo' => false]);
    }
}
