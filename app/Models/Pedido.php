<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = [
        "fecha",
        "hora",
        "monto_total",
        "estado",
        "usuario_id",
    ];
    protected $table = 'pedido';

    // Asociaciones

    // Funciones
    static public function GetPedidos()
    {
        return Pedido::all();
    }

    static public function GetPedido(int $id)
    {
        return Pedido::where('id', $id)->First();
    }

    static public function GetPedidosByUsuario(int $id)
    {
        return Pedido::where('usuario_id', $id)->get();
    }
}
