<?php

namespace App\Http\Livewire\Academico\Docente;

use App\Models\Contrato;
use App\Models\Docente;
use App\Models\Pagina;
use Livewire\Component;

class ShowDocente extends Component
{
    // Data
    public $docente;
    public $contratos = [];
    public $dataDocente = [];

    public function mount(Docente $docente)
    {
        Pagina::UpdateVisita('docente.show');
        $this->docente = $docente;
        $this->contratos = Contrato::GetContratoByDocente($docente->id);
        $this->dataDocente = [
            [
                "label" => "Nombre",
                "value" =>  $docente->honorifico . ' ' .  $docente->nombre . ' ' . $docente->apellido
            ],
            [
                "label" => "CI",
                "value" =>  $docente->ci . ' ' . $docente->ci_expedicion
            ],
            [
                "label" => "Telefono",
                "value" =>  $docente->telefono
            ],
            [
                "label" => "Correo",
                "value" =>  $docente->correo
            ]
        ];
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('docente.show');
        return view('livewire.academico.docente.show-docente', compact('visitas'))->layout(auth()->user()->tema);
    }
}
