<?php

namespace App\Http\Livewire\Public\Auth;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.public.auth.profile')->layout('layouts.public', ['fondo' => false]);
    }
}
