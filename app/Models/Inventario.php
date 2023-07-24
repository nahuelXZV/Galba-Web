<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'nombre',
        'estado',
        'unidad',
        'descripcion',
        'cantidad',
        'modelo',
        'tipo',
        'dir',
    ];
    protected $table = 'inventario';

    // Asociaciones


    // Funciones
    static public function CreateInventario(array $data)
    {
        $new = new Inventario($data);
        $new->save();
        return $new;
    }

    static public function UpdateInventario(Inventario $inventario, array $data)
    {
        $inventario->update($data);
        return $inventario;
    }

    static public function DeleteInventario(Inventario $inventario)
    {
        $inventario->delete();
        return $inventario;
    }

    static public function GetInventario(int $id)
    {
        return Inventario::find($id);
    }

    static public function GetInventarios()
    {
        return Inventario::all();
    }

    static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    {
        $inventario = Inventario::orWhere('codigo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('unidad', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('estado', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('tipo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('modelo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $inventario;
    }
}
