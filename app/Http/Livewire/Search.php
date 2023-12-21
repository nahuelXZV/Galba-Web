<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Search extends Component
{
    public $search;

    public function render()
    {
        $resultados = [];
        if ($this->search != '')
            $resultados = DB::table('users')
                ->select('id', 'name as nombre', DB::raw("'' as apellido"), DB::raw("'usuario' as tabla"))
                ->orWhere('name', 'ILIKE', '%' . strtolower($this->search)  . '%')
                ->orWhere('email', 'ILIKE', '%' . strtolower($this->search) . '%')
                ->union(
                    DB::table('proveedor')
                        ->select('id', 'nombre', DB::raw("'' as apellido"), DB::raw("'proveedor' as tabla"))
                        ->orWhere('nombre', 'ILIKE', '%' . strtolower($this->search)  . '%')
                        ->orWhere('correo', 'ILIKE', '%' . strtolower($this->search) . '%')
                )
                ->union(
                    DB::table('producto')
                        ->select('id', 'nombre', DB::raw("'' as apellido"), DB::raw("'producto' as tabla"))
                        ->orWhere('nombre', 'ILIKE', '%' . strtolower($this->search)  . '%')
                        ->orWhere('categoria', 'ILIKE', '%' . strtolower($this->search) . '%')
                )
                ->get();
        // dd($resultados);
        return view('livewire.search', compact('resultados'));
    }
}
