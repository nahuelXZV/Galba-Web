<?php

namespace App\Http\Livewire\Academico\Docente;

use App\Models\Docente;
use App\Models\Pagina;
use Livewire\Component;

class EditDocente extends Component
{
    public $docenteArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Data
    public $docente;

    // Constantes
    public $honorificos = ["Sr.", "Sra.", "Dr.", "Dra.", "Lic.", "Ing.", "MSc.", "Mg.", "Mtra.", "Mtro.", "PhD.", "PhDc."];
    public $ciExpediciones = ["LP", "CB", "SC", "BN", "PT", "CH", "TJ", "OR", "PD"];

    public function mount(Docente $docente)
    {
        Pagina::UpdateVisita('docente.edit');
        $this->docente = $docente;
        $this->docenteArray = [
            "honorifico" => $this->docente->honorifico,
            "nombre" => $this->docente->nombre,
            "apellido" => $this->docente->apellido,
            "ci" => $this->docente->ci,
            "ci_expedicion" => $this->docente->ci_expedicion,
            "telefono" => $this->docente->telefono,
            "correo" => $this->docente->correo,
            "facturacion" => $this->docente->facturacion,
        ];
    }

    public function save()
    {
        $edit = Docente::UpdateDocente($this->docente, $this->docenteArray);
        if (!$edit) {
            $this->message = 'Error al actualizar el docente';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('docente.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('docente.edit');
        return view('livewire.academico.docente.edit-docente', compact('visitas'))->layout(auth()->user()->tema);
    }
}
