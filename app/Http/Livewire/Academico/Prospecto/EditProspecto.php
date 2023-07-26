<?php

namespace App\Http\Livewire\Academico\Prospecto;

use App\Models\Pagina;
use App\Models\Prospecto;
use Livewire\Component;

class EditProspecto extends Component
{
    public $prospectoArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];

    // Data
    public $prospecto;

    // Constantes
    public $estados = [
        'Pendiente',
        'Contactado',
        'No Contactado',
        'No Interesado',
        'Interesado',
        'Matriculado',
        'No Matriculado',
    ];

    public function mount(Prospecto $prospecto)
    {
        Pagina::UpdateVisita('prospecto.edit');
        $this->prospecto = $prospecto;
        $this->prospectoArray = [
            'nombre' => $prospecto->nombre,
            'telefono' => $prospecto->telefono,
            'correo' => $prospecto->correo,
            'interes' => $prospecto->interes,
            'carrera' => $prospecto->carrera,
            'estado' => $prospecto->estado,
            'detalles' => $prospecto->detalles,
        ];
    }

    public function save()
    {
        $new = Prospecto::UpdateProspecto($this->prospecto, $this->prospectoArray);
        if (!$new) {
            $this->message = 'Error al actualizar el prospecto';
            $this->type = 'error';
            $this->notificacion = true;
            return;
        }
        return redirect()->route('prospecto.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('prospecto.edit');
        return view('livewire.academico.prospecto.edit-prospecto', compact('visitas'))
            ->layout(auth()->user()->tema);
    }
}
