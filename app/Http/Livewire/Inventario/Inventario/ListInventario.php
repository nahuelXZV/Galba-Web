<?php

namespace App\Http\Livewire\Inventario\Inventario;

use App\Models\Inventario;
use App\Models\Pagina;
use Livewire\Component;
use Livewire\WithPagination;

class ListInventario extends Component
{
    use WithPagination;
    public $search = '';
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';

    public function mount()
    {
        Pagina::UpdateVisita('inventario.list');
    }

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
        $inventario = Inventario::GetInventario($id);
        if (Inventario::DeleteInventario($inventario)) {
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
        $inventarios = Inventario::GetAllSearch($this->search, 'DESC', 10);
        $visitas = Pagina::GetPagina('inventario.list');
        return view('livewire.inventario.inventario.list-inventario', compact('inventarios', 'visitas'))->layout(auth()->user()->tema);
    }
}
