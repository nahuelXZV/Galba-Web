<?php

namespace App\Http\Livewire\Academico;

use App\Models\Pagina;
use Livewire\Component;

class Calendario extends Component
{
    public function mount()
    {
        Pagina::UpdateVisita('calendario.show');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('calendario.show');
        return view('livewire.academico.calendario', compact('visitas'))->layout(auth()->user()->tema);
    }
}
