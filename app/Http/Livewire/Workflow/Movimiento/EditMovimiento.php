<?php

namespace App\Http\Livewire\Workflow\Movimiento;

use App\Models\Documento;
use App\Models\Movimiento;
use App\Models\Pagina;
use App\Models\Recepcion;
use App\Models\Unidad;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditMovimiento extends Component
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
    public $movimiento;

    public function mount(Movimiento $movimiento)
    {
        Pagina::UpdateVisita('movimiento.edit');
        $this->movimiento = $movimiento;
        $this->recepcion = Recepcion::GetRecepcion($movimiento->recepcion_id)[0];
        $this->unidades = Unidad::GetUnidades();
        $this->movimientoArray = [
            'codigo' => $this->movimiento->codigo,
            'fecha' => $this->movimiento->fecha,
            'hora' => $this->movimiento->hora,
            'usuario_id' => $this->movimiento->usuario_id,
            'unidad_id' => $this->movimiento->unidad_id,
            'recepcion_id' => $this->movimiento->recepcion_id,
        ];
    }

    public function save()
    {
        $new = Movimiento::UpdateMovimiento($this->movimiento, $this->movimientoArray);
        if ($this->doc) {
            $url = Request::getScheme() . '://' . Request::getHost();
            $dir =  $url . '/inf513/grupo06sa/Tecno-Web-EI/public/storage/' . $this->doc->store('public/documentos', 'public');
            $documento = Documento::GetDocumentoByMovimiento($this->movimiento->id);
            if (count($documento) > 0) {
                Documento::UpdateDocumento(
                    $documento[0]->id,
                    [
                        'nombre' => $this->doc->getClientOriginalName(),
                        'tipo' => $this->doc->getClientOriginalExtension(),
                        'dir' => $dir,
                    ]
                );
            } else {
                Documento::CreateDocumento([
                    'nombre' => $this->doc->getClientOriginalName(),
                    'tipo' => $this->doc->getClientOriginalExtension(),
                    'dir' => $dir,
                    'movimiento_id' => $new->id,
                ]);
            }
        }
        if (!$new) {
            $this->message = 'Error al actualizar el movimiento';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('recepcion.show', $this->recepcion->id);
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('movimiento.edit');
        return view('livewire.workflow.movimiento.edit-movimiento', compact('visitas'))->layout(auth()->user()->tema);
    }
}
