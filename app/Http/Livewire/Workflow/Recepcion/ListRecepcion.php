<?php

namespace App\Http\Livewire\Workflow\Recepcion;

use App\Models\Recepcion;
use Livewire\Component;
use Livewire\WithPagination;

class ListRecepcion extends Component
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
        $recepcion = Recepcion::GetRecepcion($id);
        if (Recepcion::DeleteRecepcion($recepcion[0])) {
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
        $recepciones = Recepcion::GetAllSearch($this->search, 'DESC', 10);
        return view('livewire.workflow.recepcion.list-recepcion', compact('recepciones'))->layout('layouts.adulto');
    }
}
