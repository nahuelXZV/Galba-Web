<?php

namespace App\Http\Livewire\Workflow\Recepcion;

use App\Models\Documento;
use App\Models\Pagina;
use App\Models\Recepcion;
use App\Models\Unidad;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewRecepcion extends Component
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


    public function mount()
    {
        Pagina::UpdateVisita('recepcion.new');
        $this->unidades = Unidad::GetUnidades();
        $this->recepcionArray = [
            'codigo' => 'R-' . date('YmdHis'),
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s'),
            'descripcion',
            'usuario_id' => auth()->user()->id,
            'unidad_id',
        ];
    }

    public function save()
    {

        $url = Request::getScheme() . '://' . Request::getHost();
        $dir =  $url . '/inf513/grupo06sa/Tecno-Web-EI/public/storage/' . $this->doc->store('public/documentos', 'public');
        $new = Recepcion::CreateRecepcion($this->recepcionArray);
        $documento = Documento::CreateDocumento([
            'nombre' => $this->doc->getClientOriginalName(),
            'tipo' => $this->doc->getClientOriginalExtension(),
            'dir' => $dir,
            'recepcion_id' => $new->id,
        ]);
        if (!$new || !$documento) {
            $this->message = 'Error al crear la recepcion';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('recepcion.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('recepcion.new');
        return view('livewire.workflow.recepcion.new-recepcion', compact('visitas'))->layout(auth()->user()->tema);
    }
}
