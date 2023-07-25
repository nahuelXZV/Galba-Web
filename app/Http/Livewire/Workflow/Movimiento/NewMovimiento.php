<?php

namespace App\Http\Livewire\Workflow\Movimiento;

use App\Models\Documento;
use App\Models\Movimiento;
use App\Models\Recepcion;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewMovimiento extends Component
{
    use WithFileUploads;

    public $movimientoArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $doc;

    // Data
    public $unidades = [];
    public $usuarios = [];
    public $recepcion;

    public function mount(Recepcion $recepcion)
    {
        $this->recepcion = $recepcion;
        $this->unidades = Unidad::GetUnidades();
        $this->movimientoArray = [
            'codigo' => 'M-' . date('YmdHis'),
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s'),
            'usuario_id' => auth()->user()->id,
            'unidad_id',
            'recepcion_id' => $recepcion->id,
        ];
    }

    public function save()
    {
        $new = Movimiento::CreateMovimiento($this->movimientoArray);
        if ($this->doc) {
            $url = Request::getScheme() . '://' . Request::getHost();
            $dir =  $url . '/storage/' . $this->doc->store('public/documentos', 'public');
            Documento::CreateDocumento([
                'nombre' => $this->doc->getClientOriginalName(),
                'tipo' => $this->doc->getClientOriginalExtension(),
                'dir' => $dir,
                'movimiento_id' => $new->id,
            ]);
        }
        if (!$new) {
            $this->message = 'Error al crear el movimiento';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('recepcion.show', $this->recepcion->id);
    }

    public function render()
    {
        return view('livewire.workflow.movimiento.new-movimiento');
    }
}
