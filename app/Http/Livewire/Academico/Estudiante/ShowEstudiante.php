<?php

namespace App\Http\Livewire\Academico\Estudiante;

use App\Models\Estudiante;
use Livewire\Component;

class ShowEstudiante extends Component
{
    // Data
    public $estudiante;
    public $programas;
    public $dataEstudiante = [];

    public function mount(Estudiante $estudiante)
    {
        $this->estudiante = $estudiante;
        $this->programas = [];
        $this->dataEstudiante = [
            [
                "label" => "Nombre",
                "value" =>  $estudiante->honorifico . ' ' .  $estudiante->nombre . ' ' . $estudiante->apellido
            ],
            [
                "label" => "CI",
                "value" =>  $estudiante->ci . ' ' . $estudiante->ci_expedicion
            ],
            [
                "label" => "Telefono",
                "value" =>  $estudiante->telefono
            ],
            [
                "label" => "Correo",
                "value" =>  $estudiante->correo
            ],
            [
                "label" => "Carrera",
                "value" =>  $estudiante->carrera
            ],
            [
                "label" => "Universidad",
                "value" =>  $estudiante->universidad
            ],
            [
                "label" => "Estado",
                "value" =>  $estudiante->estado
            ],
            [
                "label" => "Sexo",
                "value" =>  $estudiante->sexo
            ],
            [
                "label" => "Nacionalidad",
                "value" =>  $estudiante->nacionalidad
            ],
            [
                "label" => "Fecha de inactividad",
                "value" =>  $estudiante->fecha_inactividad ?? 'N/A'
            ],
        ];
    }

    public function abandono()
    {
        Estudiante::estado($this->estudiante, "Abandono");
        return redirect()->route('estudiante.show', $this->estudiante->id);
    }

    public function reincorporar()
    {
        Estudiante::estado($this->estudiante, "Activo");
        return redirect()->route('estudiante.show', $this->estudiante->id);
    }

    public function render()
    {
        return view('livewire.academico.estudiante.show-estudiante')->layout('layouts.adulto');
    }
}
