<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombre",
    ];
    protected $table = 'unidad';

    // Asociaciones


    // Funciones
    static public function CreateUnidad(array $data)
    {
        $new = new Unidad($data);
        $new->save();
        return $new;
    }

    static public function UpdateUnidad(Unidad $unidad, array $data)
    {
        $unidad->update($data);
        return $unidad;
    }

    static public function DeleteUnidad(Unidad $unidad)
    {
        $unidad->delete();
        return $unidad;
    }

    static public function GetUnidad(int $id)
    {
        return Unidad::find($id);
    }

    static public function GetUnidades()
    {
        return Unidad::all();
    }

    static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    {
        $unidad = Unidad::orWhere('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $unidad;
    }
}
