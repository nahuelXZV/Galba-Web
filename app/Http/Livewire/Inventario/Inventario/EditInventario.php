<?php

namespace App\Http\Livewire\Inventario\Inventario;

use App\Models\Inventario;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditInventario extends Component
{
    use WithFileUploads;

    public $inventarioArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $foto;

    // Data
    public $inventario;

    // Constantes
    public $estados = ['Activo', 'Inactivo', 'En reparación', 'En mantenimiento', 'En desuso', 'En baja'];
    public $tipos = ["Mueble", "Equipo Electronico", "Material Oficina", "Otro"];

    public function mount(Inventario $inventario)
    {
        $this->inventario = $inventario;
        $this->inventarioArray = [
            'codigo' => $inventario->codigo,
            'nombre' => $inventario->nombre,
            'descripcion' => $inventario->descripcion,
            'unidad' => $inventario->unidad,
            'modelo' => $inventario->modelo,
            'cantidad' => $inventario->cantidad,
            'estado' => $inventario->estado,
            'tipo'  => $inventario->tipo,
            'dir' => $inventario->dir,
        ];
    }

    public function save()
    {
        if ($this->foto != null) {
            $url = Request::getScheme() . '://' . Request::getHost();
            $this->inventarioArray['dir'] =  $url . '/storage/' . $this->foto->store('public/inventario', 'public');
        }
        $new = Inventario::UpdateInventario($this->inventario, $this->inventarioArray);
        if (!$new) {
            $this->message = 'Error al actualizar el inventario';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('inventario.list');
    }

    public function render()
    {
        return view('livewire.inventario.inventario.edit-inventario');
    }
}
