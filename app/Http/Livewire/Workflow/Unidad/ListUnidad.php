<?php

namespace App\Http\Livewire\Workflow\Unidad;

use App\Models\Unidad;
use Livewire\Component;
use Livewire\WithPagination;

class ListUnidad extends Component
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
        $unidad = Unidad::GetUnidad($id);
        if (Unidad::DeleteUnidad($unidad)) {
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
        $unidades = Unidad::GetAllSearch($this->search, 'DESC', 10);
        return view('livewire.workflow.unidad.list-unidad', compact("unidades"))->layout('layouts.adulto');
    }
}
