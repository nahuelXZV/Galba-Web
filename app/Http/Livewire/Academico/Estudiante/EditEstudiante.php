<?php

namespace App\Http\Livewire\Academico\Estudiante;

use App\Models\Estudiante;
use App\Models\Pagina;
use Livewire\Component;

class EditEstudiante extends Component
{
    // Propiedades
    public $estudianteArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Data
    public $estudiante;

    // Constantes
    public $honorificos = ["Sr.", "Sra.", "Dr.", "Dra.", "Lic.", "Ing.", "MSc.", "Mg.", "Mtra.", "Mtro.", "PhD.", "PhDc."];
    public $sexos = ["Masculino", "Femenino", "Otro"];
    public $nacionalidades = ["Boliviana", "Extranjera"];
    public $ciExpediciones = ["LP", "CB", "SC", "BN", "PT", "CH", "TJ", "OR", "PD"];

    public function mount(Estudiante $estudiante)
    {
        Pagina::UpdateVisita('estudiante.edit');
        $this->estudiante = $estudiante;
        $this->estudianteArray = [
            'honorifico' => $estudiante->honorifico,
            'nombre' => $estudiante->nombre,
            'apellido' => $estudiante->apellido,
            'ci' => $estudiante->ci,
            'ci_expedicion' => $estudiante->ci_expedicion,
            'telefono' => $estudiante->telefono,
            'correo' => $estudiante->correo,
            'carrera' => $estudiante->carrera,
            'universidad' => $estudiante->universidad,
            'estado' => $estudiante->estado,
            'sexo' => $estudiante->sexo,
            'nacionalidad' => $estudiante->nacionalidad,
        ];
    }

    public function save()
    {
        $edit = Estudiante::UpdateEstudiante($this->estudiante, $this->estudianteArray);
        if (!$edit) {
            $this->message = 'Error al actualizar el estudiante';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('estudiante.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('estudiante.edit');
        return view('livewire.academico.estudiante.edit-estudiante', compact('visitas'))->layout(auth()->user()->tema);
    }
}
