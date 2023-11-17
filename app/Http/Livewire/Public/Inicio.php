<?php

namespace App\Http\Livewire\Public;

use Livewire\Component;

class Inicio extends Component
{
    public function render()
    {
        return view('livewire.public.inicio')->layout('layouts.public');
    }
}
