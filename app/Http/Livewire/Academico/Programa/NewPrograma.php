<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\Pagina;
use App\Models\Programa;
use Livewire\Component;

class NewPrograma extends Component
{
    public $programaArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Constantes
    public $tipos = ["Diplomado", "Curso", "Taller", "Seminario", "Otro"];
    public $modalidades = ["Presencial", "Virtual", "Semi-Presencial", "Otro"];

    public function mount()
    {
        Pagina::UpdateVisita('programa.new');
        $this->programaArray = [
            'codigo_programa' => '',
            'nombre' => '',
            'sigla' => '',
            'edicion' => '',
            'version' => '',
            'fecha_inicio' => '',
            'fecha_finalizacion' => '',
            'tipo' => '',
            'costo' => '',
            'modalidad' => '',
            'hrs_academicas' => '',
        ];
    }

    public function save()
    {
        $new = Programa::CreatePrograma($this->programaArray);
        if (!$new) {
            $this->message = 'Error al crear el programa';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('programa.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('programa.new');
        return view('livewire.academico.programa.new-programa', compact('visitas'))->layout(auth()->user()->tema);
    }
}
