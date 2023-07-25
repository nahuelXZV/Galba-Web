<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;
    protected $fillable = [
        "codigo",
        "fecha",
        "hora",
        "usuario_id",
        "unidad_id",
        "recepcion_id",
    ];
    protected $table = 'movimiento';

    // Asociaciones


    // Funciones
    static public function CreateMovimiento(array $data)
    {
        $new = new Movimiento($data);
        $new->save();
        return $new;
    }

    static public function UpdateMovimiento(Movimiento $movimiento, array $data)
    {
        $movimiento->update($data);
        return $movimiento;
    }

    static public function DeleteMovimiento(Movimiento $movimiento)
    {
        $movimiento->delete();
        return $movimiento;
    }

    static public function GetMovimiento(int $id)
    {
        return Movimiento::find($id);
    }

    static public function GetMovimientoes()
    {
        return Movimiento::all();
    }

    static public function GetMovimientoByRecepcion(int $id)
    {
        $movimientos = Movimiento::join('recepcion', 'movimiento.recepcion_id', '=', 'recepcion.id')
            ->join('unidad', 'recepcion.unidad_id', '=', 'unidad.id')
            ->join('users', 'recepcion.usuario_id', '=', 'users.id')
            ->select('movimiento.*', 'users.name as usuario', 'unidad.nombre as unidad')
            ->where('recepcion.id', $id)
            ->get();
        foreach ($movimientos as $movimiento) {
            $movimiento->documentos = Documento::GetDocumentoByMovimiento($movimiento->id);
        }
        return $movimientos;
    }

    static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    {
        $movimiento = Movimiento::orWhere('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->paginate($paginate);
        return $movimiento;
    }
}
