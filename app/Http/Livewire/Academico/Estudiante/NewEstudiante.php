<?php

namespace App\Http\Livewire\Academico\Estudiante;

use App\Models\Estudiante;
use Livewire\Component;

class NewEstudiante extends Component
{
    public $estudianteArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Constantes
    public $honorificos = ["Sr.", "Sra.", "Dr.", "Dra.", "Lic.", "Ing.", "MSc.", "Mg.", "Mtra.", "Mtro.", "PhD.", "PhDc."];
    public $sexos = ["Masculino", "Femenino", "Otro"];
    public $nacionalidades = ["Boliviana", "Extranjera"];
    public $ciExpediciones = ["LP", "CB", "SC", "BN", "PT", "CH", "TJ", "OR", "PD"];

    public function mount()
    {
        $this->estudianteArray = [
            'honorifico' => '',
            'nombre' => '',
            'apellido' => '',
            'ci' => '',
            'ci_expedicion' => '',
            'telefono' => '',
            'correo' => '',
            'carrera' => '',
            'universidad' => '',
            'estado' => 'Activo',
            'sexo' => '',
            'nacionalidad' => '',
        ];
    }

    public function save()
    {
        $new = Estudiante::CreateEstudiante($this->estudianteArray);
        if (!$new) {
            $this->message = 'Error al crear el estudiante';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('estudiante.list');
    }

    public function render()
    {
        return view('livewire.academico.estudiante.new-estudiante')->layout('layouts.adulto');
    }
}
