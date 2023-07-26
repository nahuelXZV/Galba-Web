<?php

namespace App\Http\Livewire\Academico\Modulo;

use App\Models\Docente;
use App\Models\EstudianteNota;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use App\Models\Pagina;
use App\Models\Programa;
use Livewire\Component;

class ShowModulo extends Component
{
    // Data
    public $modulo;
    public $estudiantes;
    public $dataModulo = [];

    public function mount(Modulo $modulo)
    {
        Pagina::UpdateVisita('modulo.show');
        $this->modulo = $modulo;
        $this->estudiantes = EstudiantePrograma::GetInscritosAndNotas($modulo->programa_id);
        $docente = Docente::GetDocente($modulo->docente_id);
        $programa = Programa::GetPrograma($modulo->programa_id);
        $this->dataModulo = [
            [
                "label" => "Codigo",
                "value" =>  $modulo->codigo_modulo
            ],
            [
                "label" => "Nombre",
                "value" =>  $modulo->nombre
            ],
            [
                "label" => "Programa",
                "value" =>  $programa->nombre
            ],
            [
                "label" => "Docente",
                "value" =>  $docente->honorifico . ' ' . $docente->nombre . ' ' . $docente->apellido
            ],
            [
                "label" => "Sigla",
                "value" =>  $modulo->sigla . ' ' . $modulo->edicion . ' ' . $modulo->version
            ],
            [
                "label" => "Fecha Inicio",
                "value" =>  $modulo->fecha_inicio
            ],
            [
                "label" => "Fecha Final",
                "value" =>  $modulo->fecha_finalizacion
            ],
            [
                "label" => "Modalidad",
                "value" =>  $modulo->modalidad
            ]
        ];
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('modulo.show');
        return view('livewire.academico.modulo.show-modulo', compact('visitas'))->layout(auth()->user()->tema);
    }
}
