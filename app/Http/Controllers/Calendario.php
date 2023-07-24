<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class Calendario extends Controller
{
    public function inicio()
    {
        $eventos = Evento::where('tipo_fecha', 'Inicio')->get();
        return response()->json($eventos);
    }

    public function finalizado()
    {
        $eventos = Evento::where('tipo_fecha', 'Fin')->get();
        return response()->json($eventos);
    }
}
