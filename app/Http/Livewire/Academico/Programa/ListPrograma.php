<?php

namespace App\Http\Livewire\Academico\Programa;

use App\Models\Programa;
use Livewire\Component;
use Livewire\WithPagination;

class ListPrograma extends Component
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
        $programa = Programa::GetPrograma($id);
        if (Programa::DeletePrograma($programa)) {
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
        $programas = Programa::GetAllSearch($this->search, 'DESC', 10);
        return view('livewire.academico.programa.list-programa', compact('programas'))->layout('layouts.adulto');
    }
}
