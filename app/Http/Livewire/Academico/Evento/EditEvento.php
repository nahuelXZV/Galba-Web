<?php

namespace App\Http\Livewire\Academico\Evento;

use App\Models\Evento;
use App\Models\Pagina;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class EditEvento extends Component
{
    public $eventoArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Data
    public $evento;

    // Constantes
    public $tipos = ["Conferencia", "Seminario", "Taller", "Curso", "Diplomado", "Academico", "Otro"];
    public $tipoFecha = ["Inicio", "Fin"];

    public function mount(Evento $evento)
    {
        Pagina::UpdateVisita('evento.edit');
        $this->evento = $evento;
        $this->eventoArray = [
            "title" => $evento->title,
            // solo la fecha
            "start" =>  Date::parse($evento->start)->format('Y-m-d'),
            "end" => $evento->end,
            "tipo" =>   $evento->tipo,
            "tipo_fecha" => $evento->tipo_fecha,
            "lugar" => $evento->lugar,
            "hora" => $evento->hora,
            "encargado" => $evento->encargado,
        ];
    }

    public function save()
    {
        $this->eventoArray['end'] = $this->eventoArray['start'];
        $new = Evento::UpdateEvento($this->evento, $this->eventoArray);
        if (!$new) {
            $this->message = 'Error al actualizar el evento';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('evento.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('evento.edit');
        return view('livewire.academico.evento.edit-evento', compact('visitas'))->layout(auth()->user()->tema);
    }
}
