<?php

namespace App\Http\Livewire\Inventario\Activo;

use App\Models\Activo;
use App\Models\Pagina;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditActivo extends Component
{
    use WithFileUploads;

    public $activoArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $foto;

    // Data
    public $activo;

    // Constantes
    public $estados = ['Activo', 'Inactivo', 'En reparación', 'En mantenimiento', 'En desuso', 'En baja'];
    public $tipos = ["Mueble", "Equipo Electronico", "Material Oficina", "Otro"];

    public function mount(Activo $activo)
    {
        Pagina::UpdateVisita('activo.edit');
        $this->activo = $activo;
        $this->activoArray = [
            'codigo' => $activo->codigo,
            'nombre' => $activo->nombre,
            'descripcion' => $activo->descripcion,
            'unidad' => $activo->unidad,
            'estado' => $activo->estado,
            'tipo' => $activo->tipo,
            'dir' => $activo->dir,
        ];
    }

    public function save()
    {
        if ($this->foto != null) {
            $url = Request::getScheme() . '://' . Request::getHost();
            $this->activoArray['dir'] =  $url . '/inf513/grupo06sa/Tecno-Web-EI/public/storage/' . $this->foto->store('public/activos', 'public');
        }
        $new = Activo::UpdateActivo($this->activo, $this->activoArray);
        if (!$new) {
            $this->message = 'Error al actualizar el activo';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('activo.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('activo.edit');
        return view('livewire.inventario.activo.edit-activo', compact('visitas'))->layout(auth()->user()->tema);
    }
}
