<?php

namespace App\Http\Livewire\Workflow\Recepcion;

use App\Models\Documento;
use App\Models\Movimiento;
use App\Models\Recepcion;
use Livewire\Component;

class ShowRecepcion extends Component
{
    // Data
    public $recepcion;
    public $movimientos;
    public $documento;
    public $dataRecepcion = [];

    public function mount(Recepcion $recepcion)
    {
        $this->recepcion = Recepcion::GetRecepcion($recepcion->id);
        $this->movimientos = Movimiento::GetMovimientoByRecepcion($recepcion->id);
        $this->documento = Documento::GetDocumentoByRecepcion($recepcion->id);
        $this->dataRecepcion = [
            [
                "label" => "Codigo",
                "value" =>  $this->recepcion[0]->codigo
            ],
            [
                "label" => "Fecha",
                "value" =>  $this->recepcion[0]->fecha
            ],
            [
                "label" => "Hora",
                "value" =>  $this->recepcion[0]->hora
            ],
            [
                "label" => "Recibido por",
                "value" =>  $this->recepcion[0]->usuario
            ],
            [
                "label" => "Enviado por",
                "value" =>  $this->recepcion[0]->unidad
            ],
            [
                "label" => "Descripcion",
                "value" =>  $this->recepcion[0]->descripcion
            ]
        ];
    }

    public function render()
    {
        return view('livewire.workflow.recepcion.show-recepcion')->layout('layouts.adulto');
    }
}
