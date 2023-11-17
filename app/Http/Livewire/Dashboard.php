<?php

namespace App\Http\Livewire;

use App\Models\InicioSesiones;
use App\Models\Pagina;
use Livewire\Component;

class Dashboard extends Component
{
    public $paginas;
    public $colores;
    public $ingresos = [];
    public $productos;
    public $ventas;
    public $compras;
    public $clientes;

    public function mount()
    {
        $this->paginas = Pagina::GetMoreVisited();
        $this->ingresos = InicioSesiones::GetLastSesiones();
        $this->productos = 0;
        $this->ventas = 0;
        $this->compras = 0;
        $this->clientes = 0;
    }

    public function render()
    {
        return view('livewire.dashboard')->layout(auth()->user()->tema);
    }
}
