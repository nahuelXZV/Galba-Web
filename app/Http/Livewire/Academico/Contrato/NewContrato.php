<?php

namespace App\Http\Livewire\Academico\Contrato;

use App\Models\Contrato;
use App\Models\Docente;
use App\Models\Modulo;
use Livewire\Component;

class NewContrato extends Component
{
    public $contratoArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Data
    public $docente;
    public $modulos;
    public function mount(Docente $docente)
    {
        $this->docente = $docente;
        $this->modulos = Modulo::GetModulosSinContratoDelDocente($docente->id);
        $this->contratoArray = [
            "honorario",
            "fecha_inicio",
            "fecha_finalizacion",
            "horario",
            "pagado" => '0',
            "nro_preventiva",
            "estado",
            "modulo_id",
        ];
    }

    public function save()
    {
        $new = Contrato::CreateContrato($this->contratoArray);
        if (!$new) {
            $this->message = 'Error al crear el contrato';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('docente.show', $this->docente->id);
    }

    public function render()
    {
        return view('livewire.academico.contrato.new-contrato');
    }
}
