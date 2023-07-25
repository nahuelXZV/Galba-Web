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
            $resultados = DB::table('estudiante')
                ->select('id', 'nombre', 'apellido', DB::raw("'estudiante' as tabla"))
                ->orWhere('nombre', 'ILIKE', '%' . strtolower($this->search)  . '%')
                ->orWhere('apellido', 'ILIKE', '%' . strtolower($this->search) . '%')
                ->orWhere('correo', 'ILIKE', '%' . strtolower($this->search) . '%')
                ->union(
                    DB::table('docente')
                        ->select('id', 'nombre', 'apellido', DB::raw("'docente' as tabla"))
                        ->orWhere('nombre', 'ILIKE', '%' . strtolower($this->search)  . '%')
                        ->orWhere('apellido', 'ILIKE', '%' . strtolower($this->search) . '%')
                )
                ->union(
                    DB::table('programa')
                        ->select('id', 'nombre', DB::raw("'' as apellido"), DB::raw("'programa' as tabla"))
                        ->orWhere('nombre', 'ILIKE', '%' . strtolower($this->search)  . '%')
                        ->orWhere('sigla', 'ILIKE', '%' . strtolower($this->search) . '%')
                )
                ->union(
                    DB::table('modulo')
                        ->select('id', 'nombre', DB::raw("'' as apellido"), DB::raw("'modulo' as tabla"))
                        ->orWhere('nombre', 'ILIKE', '%' . strtolower($this->search)  . '%')
                        ->orWhere('sigla', 'ILIKE', '%' . strtolower($this->search) . '%')
                )
                ->get();
        // dd($resultados);
        return view('livewire.search', compact('resultados'));
    }
}
