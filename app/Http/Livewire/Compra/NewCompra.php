<?php

namespace App\Http\Livewire\Compra;

use Livewire\Component;

class NewCompra extends Component
{
    public $compraArray = [];
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;

    public function save()
    {
        $new = Compra::CreateCompra($this->compraArray);
        if (!$new) {
            $this->message = 'Error al crear la compra';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('detalle_compra.new');
    }

    public function render()
    {
        return view('livewire.compra.new-compra');
    }
}
