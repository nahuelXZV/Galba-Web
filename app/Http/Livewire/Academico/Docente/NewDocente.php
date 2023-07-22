<?php

namespace App\Http\Livewire\Academico\Docente;

use App\Models\Docente;
use Livewire\Component;

class NewDocente extends Component
{
    public $docenteArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Constantes
    public $honorificos = ["Sr.", "Sra.", "Dr.", "Dra.", "Lic.", "Ing.", "MSc.", "Mg.", "Mtra.", "Mtro.", "PhD.", "PhDc."];
    public $ciExpediciones = ["LP", "CB", "SC", "BN", "PT", "CH", "TJ", "OR", "PD"];

    public function mount()
    {
        $this->docenteArray = [
            "honorifico" => "",
            "nombre" => "",
            "apellido" => "",
            "ci" => "",
            "ci_expedicion" => "",
            "telefono" => "",
            "correo" => "",
            "facturacion" => "true",
        ];
    }

    public function save()
    {
        $new = Docente::CreateDocente($this->docenteArray);
        if (!$new) {
            $this->message = 'Error al crear el docente';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('docente.list');
    }

    public function render()
    {
        return view('livewire.academico.docente.new-docente')->layout('layouts.adulto');
    }
}
