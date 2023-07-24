<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'nombre',
        'unidad',
        'descripcion',
        'estado',
        'tipo',
        'dir',
    ];
    protected $table = 'activos';

    // Asociaciones


    // Funciones
    static public function CreateActivo(array $data)
    {
        $new = new Activo($data);
        $new->save();
        return $new;
    }

    static public function UpdateActivo(Activo $activo, array $data)
    {
        $activo->update($data);
        return $activo;
    }

    static public function DeleteActivo(Activo $activo)
    {
        $activo->delete();
        return $activo;
    }

    static public function GetActivo(int $id)
    {
        return Activo::find($id);
    }

    static public function GetActivos()
    {
        return Activo::all();
    }

    static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    {
        $activo = Activo::orWhere('codigo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('unidad', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('estado', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('tipo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $activo;
    }
}
