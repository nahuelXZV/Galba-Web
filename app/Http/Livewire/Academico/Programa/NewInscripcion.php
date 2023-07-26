<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\Estudiante;
use App\Models\EstudiantePrograma;
use App\Models\Pagina;
use App\Models\Programa;
use Livewire\Component;
use Livewire\WithPagination;

class NewInscripcion extends Component
{
    use WithPagination;
    public $search = '';
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';

    // Data
    public $programa;
    public $listEstudents = [];

    public function mount(Programa $programa)
    {
        Pagina::UpdateVisita('programa.inscripcion');
        $this->programa = $programa;
        $inscritos = EstudiantePrograma::GetInscritosByPrograma($programa->id);
        foreach ($inscritos as $inscrito) {
            array_push($this->listEstudents, $inscrito->id_estudiante);
        }
    }

    public function save()
    {
        EstudiantePrograma::DeleteEstudiatesPrograma($this->programa->id);
        foreach ($this->listEstudents as $estudiante) {
            EstudiantePrograma::CreateEstudiantePrograma([
                'estudiante_id' => $estudiante,
                'programa_id' => $this->programa->id,
                'fecha_inscripcion' => date('Y-m-d'),
            ]);
        }
        return redirect()->route('programa.show', $this->programa->id);
    }

    public function add($estudiante)
    {
        if (in_array($estudiante, $this->listEstudents)) {
            $this->listEstudents = array_diff($this->listEstudents, [$estudiante]);
        } else {
            array_push($this->listEstudents, $estudiante);
        }
    }

    public function render()
    {
        $estudiantes = Estudiante::GetAllSearch($this->search, "desc", 10);
        $visitas = Pagina::GetPagina('programa.inscripcion');
        return view('livewire.academico.programa.new-inscripcion', compact('estudiantes', 'visitas'))
            ->layout(auth()->user()->tema);
    }
}
