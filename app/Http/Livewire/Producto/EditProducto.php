<?php

namespace App\Http\Livewire\Producto;

use Livewire\Component;
use App\Models\Producto;

class EditProducto extends Component
{
    public $productoArray = [];
    public $type = 'success';
    public $message = 'Editado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;

    public $producto;

    public function mount($producto)
    {
        $this->producto = Producto::GetProducto($producto);
        $this->productoArray = ['nombre', $this->producto->nombre];
    }

    public function save()
    {
        $new = Producto::UpdateProducto($this->productoArray);
        if (!$new) {
            $this->message = 'Error al editar el producto';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('producto.list');
    }

    public function render()
    {
        return view('livewire.producto.edit-producto')->layout(auth()->user()->tema);
    }
}
