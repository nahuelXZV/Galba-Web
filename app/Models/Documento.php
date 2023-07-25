<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombre",
        "tipo",
        "dir",
        "movimiento_id",
        "recepcion_id",
    ];
    protected $table = 'documento';

    // Asociaciones


    // Funciones
    static public function CreateDocumento(array $data)
    {
        $new = new Documento($data);
        $new->save();
        return $new;
    }

    static public function UpdateDocumento(int $documento, array $data)
    {
        $documento = Documento::find($documento);
        $documento->update($data);
        return $documento;
    }

    static public function DeleteDocumento(Documento $documento)
    {
        $documento->delete();
        return $documento;
    }

    static public function GetDocumento(int $id)
    {
        return Documento::find($id);
    }

    static public function GetDocumentoes()
    {
        return Documento::all();
    }

    static public function GetDocumentoByMovimiento(int $id)
    {
        return Documento::where('movimiento_id', $id)->get();
    }

    static public function GetDocumentoByRecepcion(int $id)
    {
        return Documento::where('recepcion_id', $id)->get();
    }
}
