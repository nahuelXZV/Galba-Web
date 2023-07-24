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
        Modulo::NuevoEvento($new);
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

    static public function GetModulosSinContratoDelDocente($docente)
    {
        return  Modulo::where('docente_id', $docente)
            ->whereNotIn('id', function ($query) {
                $query->select('modulo_id')
                    ->from('contrato');
            })->get();
    }

    static public function GetModulosByDocente(int $docente)
    {
        return Modulo::where('docente_id', $docente)->get();
    }

    static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    {
        $modulo = Modulo::orWhere('codigo_modulo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->select('modulo.*', 'programa.nombre as programa',)
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

    static private function NuevoEvento(Modulo $new)
    {
        $docente = Docente::GetDocente($new->docente_id);
        $nombreDocente = $docente->honorifico . ' ' .  $docente->nombre . ' ' . $docente->apellido;
        $evento = [
            "title" => $new->nombre,
            "start" => $new->fecha_inicio,
            "end" => $new->fecha_inicio,
            "tipo" => "Modulo",
            "tipo_fecha" => "Inicio",
            "lugar" => $new->modalidad,
            "hora" => "00:00",
            "encargado" => $nombreDocente,
        ];
        Evento::CreateEvento($evento);
        $evento['start'] = $new->fecha_finalizacion;
        $evento['end'] = $new->fecha_finalizacion;
        $evento['tipo_fecha'] = "Fin";
        Evento::CreateEvento($evento);
    }
}
