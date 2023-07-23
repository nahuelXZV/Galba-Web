<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteNota extends Model
{
    use HasFactory;
    protected $fillable = [
        'nota',
        'detalles',
        'programa_id',
        'estudiante_id',
        'modulo_id'
    ];
    protected $table = 'estudiante_nota';

    // Asociaciones


    // Funciones
    static public function CreateEstudianteNota(array $data)
    {
        $new = new EstudianteNota($data);
        $new->save();
        return $new;
    }

    static public function UpdateEstudianteNota(EstudianteNota $nota, array $data)
    {
        $nota->update($data);
        return $nota;
    }

    static public function DeleteEstudiante(EstudianteNota $nota)
    {
        $nota->delete();
        return $nota;
    }

    static public function GetEstudianteNota(int $id)
    {
        return EstudianteNota::find($id);
    }

    static public function GetEstudianteNotas()
    {
        return EstudianteNota::all();
    }

    static public function getNotaByEstudianteAndModulo($estudiante, $modulo)
    {
        return EstudianteNota::where('estudiante_id', $estudiante)->where('modulo_id', $modulo)->first();
    }
}
