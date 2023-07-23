<?php

namespace App\Http\Livewire\Academico\Modulo;

use App\Models\Modulo;
use Livewire\Component;

class EditModulo extends Component
{
    public $moduloArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Data
    public $modulo;

    // Constantes
    public $modalidades = ["Presencial", "Virtual", "Semi-Presencial", "Otro"];

    public function mount(Modulo $modulo)
    {
        $this->modulo = $modulo;
        $this->moduloArray = [
            'codigo_modulo' => $this->modulo->codigo_modulo,
            'nombre' =>     $this->modulo->nombre,
            'sigla' =>     $this->modulo->sigla,
            'edicion' =>    $this->modulo->edicion,
            'version' =>   $this->modulo->version,
            'fecha_inicio' =>  $this->modulo->fecha_inicio,
            'fecha_finalizacion' => $this->modulo->fecha_finalizacion,
            'modalidad' => $this->modulo->modalidad,
        ];
    }

    public function save()
    {
        $edit = Modulo::UpdateModulo($this->modulo, $this->moduloArray);
        if (!$edit) {
            $this->message = 'Error al actualizar el modulo';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('modulo.list');
    }

    public function render()
    {
        return view('livewire.academico.modulo.edit-modulo')->layout('layouts.adulto');
    }
}
