<?php

namespace App\Http\Livewire\Academico\Evento;

use App\Models\Evento;
use Livewire\Component;

class NewEvento extends Component
{
    public $eventoArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Constantes
    public $tipos = ["Conferencia", "Seminario", "Taller", "Curso", "Diplomado", "Academico", "Otro"];
    public $tipoFecha = ["Inicio", "Fin"];

    public function mount()
    {
        $this->eventoArray = [
            "title" => "",
            "start" => "",
            "end" => "",
            "tipo" => "",
            "tipo_fecha" => "Inicio",
            "lugar" => "",
            "hora" => "",
            "encargado" => "",
        ];
    }

    public function save()
    {
        $this->eventoArray['end'] = $this->eventoArray['start'];
        $new = Evento::CreateEvento($this->eventoArray);
        if (!$new) {
            $this->message = 'Error al crear el evento';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('evento.list');
    }

    public function render()
    {
        return view('livewire.academico.evento.new-evento')->layout('layouts.adulto');
    }
}
