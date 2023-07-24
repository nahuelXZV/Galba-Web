<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'start',
        'end',
        'tipo',
        'tipo_fecha',
        'lugar',
        'hora',
        'encargado',
    ];
    protected $table = 'calendario_academico';

    // Asociaciones


    // Funciones
    static public function CreateEvento(array $data)
    {
        $new = new Evento($data);
        $new->save();
        return $new;
    }

    static public function UpdateEvento(Evento $evento, array $data)
    {
        $evento->update($data);
        return $evento;
    }

    static public function DeleteEvento(Evento $evento)
    {
        $evento->delete();
        return $evento;
    }

    static public function GetEvento(int $id)
    {
        return Evento::find($id);
    }

    static public function Geteventos()
    {
        return Evento::all();
    }

    static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    {
        $evento = Evento::orWhere('title', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('tipo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('lugar', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('encargado', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $evento;
    }
}
