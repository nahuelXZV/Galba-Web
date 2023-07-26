<?php

namespace App\Http\Livewire\Academico\Prospecto;

use App\Models\Pagina;
use App\Models\Prospecto;
use Livewire\Component;
use Livewire\WithPagination;

class ListProspecto extends Component
{
    use WithPagination;
    public $search = '';
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';

    public function mount()
    {
        Pagina::UpdateVisita('prospecto.list');
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
        $prospecto = Prospecto::GetProspecto($id);
        if (Prospecto::DeleteProspecto($prospecto)) {
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
        $prospectos = Prospecto::GetAllSearch($this->search, 'DESC', 10);
        $visitas = Pagina::GetPagina('prospecto.list');
        return view('livewire.academico.prospecto.list-prospecto', compact('prospectos', 'visitas'))
            ->layout(auth()->user()->tema);
    }
}
