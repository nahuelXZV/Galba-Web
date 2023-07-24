<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    protected $fillable = [
        "honorario",
        "fecha_inicio",
        "fecha_finalizacion",
        "horario",
        "pagado",
        "nro_preventiva",
        "estado",
        "modulo_id",
    ];
    protected $table = 'contrato';

    // Asociaciones


    // Funciones
    static public function CreateContrato(array $data)
    {
        $modulo = Modulo::GetModulo($data['modulo_id']);
        $data['fecha_inicio'] = $modulo->fecha_inicio;
        $data['fecha_finalizacion'] = $modulo->fecha_finalizacion;
        $data['nro_preventiva'] = "";
        if (now() > $modulo->fecha_finalizacion)
            $data['estado'] = "Vigente";
        else
            $data['estado'] = "Finalizado";
        $new = new Contrato($data);
        $new->save();
        return $new;
    }

    static public function UpdateContrato(Contrato $contrato, array $data)
    {
        $modulo = Modulo::GetModulo($data['modulo_id']);
        if (now() > $modulo->fecha_finalizacion)
            $data['estado'] = "Vigente";
        else
            $data['estado'] = "Finalizado";
        $contrato->update($data);
        return $contrato;
    }

    static public function DeleteContrato(Contrato $contrato)
    {
        $contrato->delete();
        return $contrato;
    }

    static public function GetContrato(int $id)
    {
        return Contrato::find($id);
    }

    static public function GetContratos()
    {
        return Contrato::all();
    }

    static public function GetContratoByDocente(int $id)
    {
        $docente = Docente::GetDocente($id);
        $modulos = Modulo::GetModulosByDocente($docente->id);
        $contratos = [];
        foreach ($modulos as $modulo) {
            $contrato = Contrato::join('modulo', 'modulo.id', '=', 'contrato.modulo_id')
                ->select('contrato.*', 'modulo.nombre as modulo')
                ->where('modulo_id', $modulo->id)->first();
            if ($contrato)
                array_push($contratos, $contrato);
        }
        return $contratos;
    }
}
