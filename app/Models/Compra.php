<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\Models\DetalleCompra;

class Compra extends Model
{
    protected $fillable = [
        "fecha",
        "hora",
        "monto_total",
        "proveedor_id"
    ];
    protected $table = 'compra';
    use HasFactory;
    // Funciones
    static public function CreateCompra(array $data)
    {
        $new = Producto::create([
            'fecha' => $data['fecha'],
            'hora' => $data['hora'],
            'monto_total' => 0,
            'proveedor_id' => $data['proveedor_id']
        ]);
        return $new;
    }

    static public function UpdateCompra($id, array $data)
    {
        $compra = Compra::find($id);
        $compra->monto_total = $data['monto_total'] ?? $producto->monto_total;

        $compra->save();
        return $producto;
    }

    static public function DeleteCompra($id)
    {
        $compra = Compra::find($id);

        $detallesCompra = DetalleCompra::where('compra_id', $id)->get();
        foreach ($detallesCompra as $detalle) {           d;
            $cantidad = $detalle->cantidad;
            //actualizar datos en el producto
            $producto = Producto::updateStock($detalle->producto_id, -$detalle->cantidad);
            //eliminar detalle
            $detalle->delete();
        }

        $compra->delete();
        return $compra;
    }

    static public function GetCompras($attribute, $order = "desc", $paginate)
    {
        $compra = Compra::where('fecha', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $compra;
    }

    static public function GetAllCompras()
    {
        $compra = Compra::all();
        return $compra;
    }

    static public function GetProducto($id)
    {
        $compra = Compra::find($id);
        return $compra;
    }
}
