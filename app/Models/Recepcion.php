<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;
    protected $fillable = [
        "codigo",
        "fecha",
        "hora",
        "descripcion",
        "usuario_id",
        "unidad_id",
    ];
    protected $table = 'recepcion';

    // Asociaciones


    // Funciones
    static public function CreateRecepcion(array $data)
    {
        $new = new Recepcion($data);
        $new->save();
        dd($new);
        return $new;
    }

    static public function UpdateRecepcion(Recepcion $recepcion, array $data)
    {
        $recepcion->update($data);
        return $recepcion;
    }

    static public function DeleteRecepcion(Recepcion $recepcion)
    {
        $recepcion->delete();
        return $recepcion;
    }

    static public function GetRecepcion(int $id)
    {
        return Recepcion::join('unidad', 'recepcion.unidad_id', '=', 'unidad.id')
            ->join('users', 'recepcion.usuario_id', '=', 'users.id')
            ->select('recepcion.*', 'unidad.nombre as unidad', 'users.name as usuario')
            ->where('recepcion.id', $id)
            ->get();
    }

    static public function GetRecepciones()
    {
        return Recepcion::all();
    }

    static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    {
        $recepcion = Recepcion::join('unidad', 'recepcion.unidad_id', '=', 'unidad.id')
            ->join('users', 'recepcion.usuario_id', '=', 'users.id')
            ->select('recepcion.*', 'unidad.nombre as unidad', 'users.name as usuario')
            ->orWhere('codigo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('users.name', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('users.area', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('unidad.nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('recepcion.id', $order)
            ->paginate($paginate);
        return $recepcion;
    }
}
