<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        "nombre",
        "imagen",
        "tamaño",
        "precio",
        "cantidad",
        "descripcion",
        "categoria"
    ];
    protected $table = 'producto';
    use HasFactory;
    // Funciones
    static public function CreateProducto(array $data)
    {
        $new = Producto::create([
            'nombre' => $data['nombre'],
            'imagen' => $data['imagen'],
            'tamaño' => $data['tamaño'],
            'precio' => $data['precio'],
            'cantidad' => $data['cantidad'],
            'descripcion' => $data['descripcion'],
            'categoria' => $data['categoria']
        ]);
        return $new;
    }

    static public function UpdateProducto($id, array $data)
    {
        $producto = Producto::find($id);
        $producto->nombre = $data['nombre'];
        $producto->imagen = $data['imagen'];
        $producto->tamaño = $data['tamaño'];
        $producto->precio = $data['precio'];
        $producto->cantidad = $data['cantidad'];
        $producto->descripcion = $data['descripcion'];

        $producto->save();
        return $producto;
    }

    static public function DeleteProducto($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return $user;
    }

    static public function GetProductos($attribute, $order = "desc", $paginate)
    {
        $producto = Producto::where('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $producto;
    }

    static public function GetAllProductos()
    {
        $producto = Producto::all();
        return $producto;
    }

    static public function GetProducto($id)
    {
        $producto = Producto::find($id);
        return $producto;
    }
}
