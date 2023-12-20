<?php

namespace App\Http\Livewire\Public\Producto;

use App\Models\Producto;
use Livewire\Component;

class ListProduct extends Component
{
    public $productos;

    public function mount()
    {
        $this->productos = Producto::GetAllProductos();
    }

    function addCart($id)
    {
        $this->emit('addCart', $id, 1);
    }

    public function render()
    {
        return view('livewire.public.producto.list-product')->layout('layouts.public', ['fondo' => false]);
    }
}
