<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospecto extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombre",
        "telefono",
        "correo",
        "interes",
        "carrera",
        "estado",
        "detalles"
    ];
    protected $table = 'prospecto';

    // Asociaciones


    // Funciones
    static public function CreateProspecto(array $data)
    {
        $new = new Prospecto($data);
        $new->save();
        return $new;
    }

    static public function UpdateProspecto(Prospecto $prospecto, array $data)
    {
        $prospecto->update($data);
        return $prospecto;
    }

    static public function DeleteProspecto(Prospecto $prospecto)
    {
        $prospecto->delete();
        return $prospecto;
    }

    static public function GetProspecto(int $id)
    {
        return Prospecto::find($id);
    }

    static public function GetProspectos()
    {
        return Prospecto::all();
    }

    static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    {
        $prospecto = Prospecto::orWhere('interes', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('correo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('telefono', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('carrera', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $prospecto;
    }
}
