<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\Modulo;
use App\Models\Pagina;
use App\Models\Programa;
use Livewire\Component;

class ShowPrograma extends Component
{
    // Data
    public $programa;
    public $modulos;
    public $dataEstudiante = [];

    public function mount(Programa $programa)
    {
        Pagina::UpdateVisita('programa.show');
        $this->programa = $programa;
        $this->modulos = Modulo::GetModulosByPrograma($programa->id);
        $this->dataEstudiante = [
            [
                "label" => "Nombre",
                "value" =>  $programa->nombre
            ],
            [
                "label" => "Codigo",
                "value" =>  $programa->codigo_programa
            ],
            [
                "label" => "Sigla",
                "value" =>  $programa->sigla . ' ' . $programa->edicion . ' ' . $programa->version
            ],
            [
                "label" => "Fecha Inicio",
                "value" =>  $programa->fecha_inicio
            ],
            [
                "label" => "Fecha Final",
                "value" =>  $programa->fecha_finalizacion
            ],
            [
                "label" => "Tipo",
                "value" =>  $programa->tipo
            ],
            [
                "label" => "Costo",
                "value" =>  $programa->costo
            ],
            [
                "label" => "Modalidad",
                "value" =>  $programa->modalidad
            ],
            [
                "label" => "Hrs Academicas",
                "value" =>  $programa->hrs_academicas
            ]
        ];
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('programa.show');
        return view('livewire.academico.programa.show-programa', compact('visitas'))->layout(auth()->user()->tema);
    }
}
