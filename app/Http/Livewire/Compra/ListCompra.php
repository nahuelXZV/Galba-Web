<?php

namespace App\Http\Livewire\Compra;

use Livewire\Component;
use App\Models\Proveedor;
use Livewire\WithPagination;
use App\Models\Compra;

class ListCompra extends Component
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
        return redirect()->route('compra.show',$id);
    }

    public function delete($id)
    {
        if (Compra::DeleteCompra($id)) {
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
        $compras = Compra::GetAllCompras();
        return view('livewire.compra.list-compra', compact('compras'));
    }
}
