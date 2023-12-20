<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    protected $fillable = [
        "cantidad",
        "precio",
        "compra_id",
        "producto_id"
    ];
    protected $table = 'compra_detalle';
    use HasFactory;

    // Funciones
    static public function CreateCompraDetalle(array $data)
    {
        $new = CompraDetalle::create([
            'cantidad' => $data['cantidad'],
            'precio' => $data['precio'],
            'compra_id' => $data['compra_id'],
            'producto_id' => $data['producto_id']
        ]);
        return $new;
    }

    static public function DeleteCompraDetalle($id)
    {
        $compraDetalle = CompraDetalle::find($id);
        $compraDetalle->delete();
        return $compraDetalle;
    }

    static public function GetCompraDetallesByIdCompra($id)
    {
        $compraDetalle = CompraDetalle::DetalleCompra::where('compra_id', $id)->get()
            ->paginate($paginate);
        return $compraDetalle;
    }

    static public function GetCompraDetalle($id)
    {
        $compraDetalle = CompraDetalle::find($id);
        return $compraDetalle;
    }
}
