<?php

namespace App\Http\Livewire\Academico\Contrato;

use App\Models\Contrato;
use App\Models\Docente;
use App\Models\Modulo;
use App\Models\Pagina;
use Livewire\Component;

class EditContrato extends Component
{
    public $contratoArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Data
    public $contrato;
    public $docente;

    public function mount(Contrato $contrato)
    {
        Pagina::UpdateVisita('contrato.edit');
        $this->contrato = $contrato;
        $modulo = Modulo::GetModulo($contrato->modulo_id);
        $this->docente = Docente::GetDocente($modulo->docente_id);
        $this->contratoArray = [
            "honorario" => $contrato->honorario,
            "fecha_inicio" => $contrato->fecha_inicio,
            "fecha_finalizacion" => $contrato->fecha_finalizacion,
            "horario"   => $contrato->horario,
            "pagado" => $contrato->pagado,
            "nro_preventiva" => $contrato->nro_preventiva,
            "estado" => $contrato->estado,
            "modulo_id" => $contrato->modulo_id,
        ];
    }

    public function save()
    {
        $new = Contrato::UpdateContrato($this->contrato, $this->contratoArray);
        if (!$new) {
            $this->message = 'Error al actualizar el contrato';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('docente.show', $this->docente->id);
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('contrato.edit');
        return view('livewire.academico.contrato.edit-contrato', compact('visitas'))->layout(auth()->user()->tema);
    }
}
