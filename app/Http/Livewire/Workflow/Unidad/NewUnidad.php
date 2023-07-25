<?php

namespace App\Http\Livewire\Workflow\Unidad;

use App\Models\Unidad;
use Livewire\Component;

class NewUnidad extends Component
{
    public $unidadArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    public function mount()
    {
        $this->unidadArray = [
            'nombre',
        ];
    }

    public function save()
    {
        $new = Unidad::CreateUnidad($this->unidadArray);
        if (!$new) {
            $this->message = 'Error al crear la unidad';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('unidad.list');
    }

    public function render()
    {
        return view('livewire.workflow.unidad.new-unidad')->layout('layouts.adulto');
    }
}
