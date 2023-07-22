<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $fillable = [
        "honorifico",
        "nombre",
        "apellido",
        "ci",
        "ci_expedicion",
        "telefono",
        "correo",
        "facturacion",
    ];
    protected $table = 'docente';

    // Asociaciones


    // Funciones
    static public function CreateDocente(array $data)
    {
        $new = new Docente($data);
        $new->save();
        return $new;
    }

    static public function UpdateDocente(Docente $docente, array $data)
    {
        $docente->update($data);
        return $docente;
    }

    static public function DeleteDocente(Docente $docente)
    {
        $docente->delete();
        return $docente;
    }

    static public function GetDocente(int $id)
    {
        return Docente::find($id);
    }

    static public function GetDocentes()
    {
        return Docente::all();
    }

    static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    {
        $docente = Docente::orWhere('honorifico', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('apellido', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('correo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('telefono', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('ci', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $docente;
    }
}
