<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\Pagina;
use App\Models\Programa;
use Livewire\Component;

class EditPrograma extends Component
{
    public $programaArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Data
    public $programa;

    // Constantes
    public $tipos = ["Diplomado", "Curso", "Taller", "Seminario", "Otro"];
    public $modalidades = ["Presencial", "Virtual", "Semi-Presencial", "Otro"];

    public function mount(Programa $programa)
    {
        Pagina::UpdateVisita('programa.edit');
        $this->programa = $programa;
        $this->programaArray = [
            'codigo_programa' => $programa->codigo_programa,
            'nombre' => $programa->nombre,
            'sigla' => $programa->sigla,
            'edicion' => $programa->edicion,
            'version' => $programa->version,
            'fecha_inicio' => $programa->fecha_inicio,
            'fecha_finalizacion' => $programa->fecha_finalizacion,
            'tipo' => $programa->tipo,
            'costo' => $programa->costo,
            'modalidad' => $programa->modalidad,
            'hrs_academicas' => $programa->hrs_academicas,
        ];
    }

    public function save()
    {
        $edit = Programa::UpdatePrograma($this->programa, $this->programaArray);
        if (!$edit) {
            $this->message = 'Error al actualizar el programa';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('programa.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('programa.edit');
        return view('livewire.academico.programa.edit-programa', compact('visitas'))->layout(auth()->user()->tema);
    }
}
