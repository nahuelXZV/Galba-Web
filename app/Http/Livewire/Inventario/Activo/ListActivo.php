<?php

namespace App\Http\Livewire\Inventario\Activo;

use App\Models\Activo;
use Livewire\Component;
use Livewire\WithPagination;

class ListActivo extends Component
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
        $activo = Activo::GetActivo($id);
        if (Activo::DeleteActivo($activo)) {
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
        $activos = Activo::GetAllSearch($this->search, 'DESC', 10);
        return view('livewire.inventario.activo.list-activo', compact('activos'));
    }
}
