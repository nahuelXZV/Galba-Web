<?php

namespace App\Http\Livewire\Academico\Modulo;

use App\Models\Modulo;
use Livewire\Component;
use Livewire\WithPagination;

class ListModulo extends Component
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
        $modulo = Modulo::GetModulo($id);
        if (Modulo::DeleteModulo($modulo)) {
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
        $modulos = Modulo::GetAllSearch($this->search, 'DESC', 10);
        return view('livewire.academico.modulo.list-modulo', compact('modulos'))->layout('layouts.adulto');
    }
}
