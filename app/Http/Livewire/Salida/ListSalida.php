<?php

namespace App\Http\Livewire\Salida;

use Livewire\Component;
use App\Models\Proveedor;
use Livewire\WithPagination;
use App\Models\Salida;

class ListSalida extends Component
{
    use WithPagination;
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $layout;

    public function toggleNotificacion()
    {
        $this->notificacion = !$this->notificacion;
        $this->emit('notificacion');
    }

    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function edit($id){
        return redirect()->route('salida.show',$id);
    }

    public function delete($id)
    {
        if (Salida::DeleteSalida($id)) {
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
        return view('livewire.salida.list-salida');
    }
}
