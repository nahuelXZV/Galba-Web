<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;
    protected $fillable = [
        "codigo_modulo",
        "nombre",
        "sigla",
        "edicion",
        "version",
        "fecha_inicio",
        "fecha_finalizacion",
        "modalidad",
        "programa_id",
        "docente_id",
    ];
    protected $table = 'modulo';

    // Asociaciones


    // Funciones
    static public function CreateModulo(array $data)
    {
        $new = new Modulo($data);
        $new->save();
        return $new;
    }

    static public function UpdateModulo(Modulo $modulo, array $data)
    {
        $modulo->update($data);
        return $modulo;
    }

    static public function DeleteModulo(Modulo $modulo)
    {
        $modulo->delete();
        return $modulo;
    }

    static public function GetModulo(int $id)
    {
        return Modulo::find($id);
    }

    static public function GetModulos()
    {
        return Modulo::all();
    }

    static public function GetModulosByPrograma($programa)
    {
        return Modulo::where('programa_id', $programa)->get();
    }

    static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    {
        $modulo = Modulo::orWhere('codigo_modulo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->select('modulo.*', 'programa.nombre as programa')
            ->join('programa', 'programa.id', '=', 'modulo.programa_id')
            ->join('docente', 'docente.id', '=', 'modulo.docente_id')
            ->orWhere('modulo.nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('modulo.sigla', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('modulo.modalidad', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('programa', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('modulo.id', $order)
            ->paginate($paginate);
        return $modulo;
    }
}
