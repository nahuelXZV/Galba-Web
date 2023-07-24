<?php

namespace App\Http\Livewire\Academico;

use Livewire\Component;

class Calendario extends Component
{
    public function render()
    {
        return view('livewire.academico.calendario')->layout('layouts.adulto');
    }
}
