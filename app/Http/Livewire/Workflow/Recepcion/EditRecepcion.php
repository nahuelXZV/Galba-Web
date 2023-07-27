<?php

namespace App\Http\Livewire\Workflow\Recepcion;

use App\Models\Documento;
use App\Models\Pagina;
use App\Models\Recepcion;
use App\Models\Unidad;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Psy\Readline\Hoa\Console;

class EditRecepcion extends Component
{
    use WithFileUploads;

    public $recepcionArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $doc;

    // Data
    public $unidades = [];
    public $recepcion;

    public function mount(Recepcion $recepcion)
    {
        Pagina::UpdateVisita('recepcion.edit');
        $this->recepcion = $recepcion;
        $this->unidades = Unidad::GetUnidades();
        $this->recepcionArray = [
            'codigo' => $this->recepcion->codigo,
            'fecha' => $this->recepcion->fecha,
            'hora' => $this->recepcion->hora,
            'descripcion' => $this->recepcion->descripcion,
            'usuario_id' => auth()->user()->id,
            'unidad_id' => $this->recepcion->unidad_id,
        ];
    }

    public function save()
    {
        $docEdit = true;
        if ($this->doc) {
            $url = Request::getScheme() . '://' . Request::getHost();
            $dir =  $url . '/inf513/grupo06sa/Tecno-Web-EI/public/storage/' . $this->doc->store('public/documentos', 'public');
            $documento = Documento::GetDocumentoByRecepcion($this->recepcion->id);
            if ($documento) {
                $docEdit = Documento::UpdateDocumento($documento[0]->id, [
                    'nombre' => $this->doc->getClientOriginalName(),
                    'tipo' => $this->doc->getClientOriginalExtension(),
                    'dir' => $dir,
                ]);
            }
        }
        $edit = Recepcion::UpdateRecepcion($this->recepcion, $this->recepcionArray);
        if (!$edit || !$docEdit) {
            $this->message = 'Error al actualizar la recepcion';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('recepcion.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('recepcion.edit');
        return view('livewire.workflow.recepcion.edit-recepcion', compact('visitas'))->layout(auth()->user()->tema);
    }
}
