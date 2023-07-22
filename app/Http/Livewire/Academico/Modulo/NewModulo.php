<?php

namespace App\Http\Livewire\Academico\Modulo;

use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Programa;
use Livewire\Component;

class NewModulo extends Component
{
    public $moduloArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Data
    public $programas;
    public $docentes;

    // Constantes
    public $modalidades = ["Presencial", "Virtual", "Semi-Presencial", "Otro"];

    public function mount()
    {
        $this->programas = Programa::all();
        $this->docentes = Docente::all();
        $this->moduloArray = [
            'codigo_modulo' => '',
            'nombre' => '',
            'sigla' => '',
            'edicion' => '',
            'version' => '',
            'fecha_inicio' => '',
            'fecha_finalizacion' => '',
            'modalidad' => '',
            'programa_id' => '',
            'docente_id' => '',
        ];
    }

    public function save()
    {
        $new = Modulo::CreateModulo($this->moduloArray);
        if (!$new) {
            $this->message = 'Error al crear el modulo';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('modulo.list');
    }

    public function render()
    {
        return view('livewire.academico.modulo.new-modulo')->layout('layouts.adulto');
    }
}
