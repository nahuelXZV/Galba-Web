<?php

namespace App\Http\Livewire\Producto;

use Livewire\Component;
use App\Models\Producto;

class NewProducto extends Component
{
    public $productoArray = [];
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;

    public function save()
    {
        $new = Producto::CreateProducto($this->productoArray);
        if (!$new) {
            $this->message = 'Error al crear el producto';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('producto.list');
    }

    public function render()
    {
        return view('livewire.producto.new-producto');
    }
}
