<?php

namespace App\Http\Livewire;

use App\Models\Estudiante;
use App\Models\Evento;
use App\Models\InicioSesiones;
use App\Models\Modulo;
use App\Models\Pagina;
use App\Models\Programa;
use App\Models\Prospecto;
use Livewire\Component;

class Dashboard extends Component
{
    public $paginas;
    public $colores;
    public $ingresos = [];
    public $modulos;
    public $programas;
    public $eventos;
    public $estudiantes;

    public function mount()
    {
        $this->paginas = Pagina::GetMoreVisited();
        $this->ingresos = InicioSesiones::GetLastSesiones();
        $this->modulos = Modulo::whereDate('fecha_finalizacion', '>=', now())->count();
        $this->programas = Programa::whereDate('fecha_finalizacion', '>=', now())->count();
        $this->eventos = Evento::whereDate('end', '>=', now())->count();
        $this->estudiantes = Estudiante::where('estado', 'Activo')->count();
        $this->colores = [
            '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A',
            '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D',
            '#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6',
            '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',
        ];
    }

    public function render()
    {
        return view('livewire.dashboard')->layout(auth()->user()->tema);
    }
}
