<?php

namespace App\Http\Livewire\Sistema\Rol;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class ListRol extends Component
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
        if (Role::DeleteUsuario($id)) {
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
        $roles = Role::where('name', 'ILIKE', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('livewire.sistema.rol.list-rol', compact('roles'))->layout('layouts.adulto');
    }
}
