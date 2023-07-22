<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;
    protected $fillable = [
        "codigo_programa",
        "nombre",
        "sigla",
        "edicion",
        "version",
        "fecha_inicio",
        "fecha_finalizacion",
        "tipo",
        "costo",
        "modalidad",
        "hrs_academicas",
    ];
    protected $table = 'programa';

    // Asociaciones


    // Funciones
    static public function CreatePrograma(array $data)
    {
        $new = new Programa($data);
        $new->save();
        return $new;
    }

    static public function UpdatePrograma(Programa $programa, array $data)
    {
        $programa->update($data);
        return $programa;
    }

    static public function DeletePrograma(Programa $programa)
    {
        $programa->delete();
        return $programa;
    }

    static public function GetPrograma(int $id)
    {
        return Programa::find($id);
    }

    static public function GetProgramas()
    {
        return Programa::all();
    }

    static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    {
        $programa = Programa::orWhere('codigo_programa', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('sigla', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('tipo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('modalidad', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $programa;
    }
}
