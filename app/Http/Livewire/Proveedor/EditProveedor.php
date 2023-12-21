<?php

namespace App\Http\Livewire\Proveedor;

use Livewire\Component;

class EditProveedor extends Component
{
    public function render()
    {
        return view('livewire.proveedor.edit-proveedor')->layout(auth()->user()->tema);
    }
}
