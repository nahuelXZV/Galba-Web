<?php

namespace App\Http\Livewire\Academico\Evento;

use App\Models\Evento;
use Livewire\Component;
use Livewire\WithPagination;

class ListEvento extends Component
{
    use WithPagination;
    public $search = '';
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';

    public function toggleNotificacion()
    {
        $this->notificacion = !$this->notificacion;
        $this->emit('notificacion');
    }

    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $evento = Evento::GetEvento($id);
        if (Evento::DeleteEvento($evento)) {
            $this->message = 'Eliminado correctamente';
            $this->type = 'success';
        } else {
            $this->message = 'Error al eliminar';
            $this->type = 'error';
        }
        $this->notificacion = true;
    }

    public function render()
    {
        $eventos = Evento::GetAllSearch($this->search, 'DESC', 10);
        return view('livewire.academico.evento.list-evento', compact('eventos'))->layout('layouts.adulto');
    }
}
