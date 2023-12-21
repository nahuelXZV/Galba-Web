<?php

namespace App\Http\Livewire\Proveedor;

use Livewire\Component;

class NewProveedor extends Component
{
    public function render()
    {
        return view('livewire.proveedor.new-proveedor')->layout(auth()->user()->tema);
    }
}
