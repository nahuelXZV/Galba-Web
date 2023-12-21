<?php

namespace App\Http\Livewire\IngresoDetalle;

use Livewire\Component;
use App\Models\Ingreso;
use App\Models\IngresoDetalle;
use App\Models\Producto;

class NewIngresoDetalle extends Component
{
    public $detalleArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;
    public $ingreso_id;

    public $productos = [];

    public function mount($id)
    {
        $this->layout = auth()->user()->tema;
        $this->productos = Producto::GetAllProductos();
        $this->ingreso_id = $id;
        $this->detalleArray = ['ingreso_id' => $id];
    }

    public function save()
    {
        $new = IngresoDetalle::CreateIngresoDetalle($this->detalleArray);
        if (!$new) {
            $this->message = 'Error al añadir el detalle';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('ingreso.show', $this->ingreso_id);
    }

    public function render()
    {
        return view('livewire.ingreso-detalle.new-ingreso-detalle')->layout(auth()->user()->tema);
    }
}
