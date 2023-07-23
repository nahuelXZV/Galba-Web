<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudiantePrograma extends Model
{
    use HasFactory;
    protected $fillable = [
        'estudiante_id',
        'programa_id',
        'fecha_inscripcion',
    ];
    protected $table = 'estudiante_programa';

    // Asociaciones


    // Funciones
    static public function CreateEstudiantePrograma(array $data)
    {
        $new = new EstudiantePrograma($data);
        $new->save();
        return $new;
    }

    static public function UpdateEstudiantePrograma(EstudiantePrograma $inscripcion, array $data)
    {
        $inscripcion->update($data);
        return $inscripcion;
    }

    static public function DeleteEstudiante(EstudiantePrograma $inscripcion)
    {
        $inscripcion->delete();
        return $inscripcion;
    }

    static public function GetEstudiantePrograma(int $id)
    {
        return EstudiantePrograma::find($id);
    }

    static public function GetInscritosByPrograma($programa)
    {
        return EstudiantePrograma::where('programa_id', $programa)->get();
    }

    static public function GetProgramasByEstudiante($estudiante)
    {
        return EstudiantePrograma::join('programa', 'estudiante_programa.programa_id', '=', 'programa.id')
            ->select('programa.*')
            ->where('estudiante_id', $estudiante)->get();
    }

    static public function IsInscrito($programa, $estudiante)
    {
        $inscrito = EstudiantePrograma::where('programa_id', $programa)->where('estudiante_id', $estudiante)->first();
        if ($inscrito) {
            return true;
        }
        return false;
    }

    static public function DeleteEstudiatesPrograma($programa)
    {
        $inscritos = EstudiantePrograma::where('programa_id', $programa)->get();
        foreach ($inscritos as $inscrito) {
            $inscrito->delete();
        }
    }

    static public function GetInscritosAndNotas($programa)
    {
        $inscritos = EstudiantePrograma::where('programa_id', $programa)->get();
        $inscritosAndNotas = [];
        foreach ($inscritos as $inscrito) {
            $estudiante = Estudiante::GetEstudiante($inscrito->estudiante_id);
            $nota = EstudianteNota::where('estudiante_id', $inscrito->estudiante_id)->where('programa_id', $programa)->first();
            if ($nota) {
                array_push($inscritosAndNotas, [
                    'estudiantePrograma' => $inscrito->id,
                    'estudianteNota' => $nota->id,
                    'estudiante' => $estudiante->id,
                    'modulo' => $nota->modulo,
                    'nombre' => $estudiante->honorifico . ' ' . $estudiante->nombre . ' ' . $estudiante->apellido,
                    'correo' => $estudiante->correo,
                    'telefono' => $estudiante->telefono,
                    'nota' => $nota->nota,
                    'detalles' => $nota->detalles,
                ]);
            } else {
                array_push($inscritosAndNotas, [
                    'estudiantePrograma' => $inscrito->id,
                    'estudianteNota' => null,
                    'estudiante' => $estudiante->id,
                    'modulo' => null,
                    'nombre' => $estudiante->honorifico . ' ' . $estudiante->nombre . ' ' . $estudiante->apellido,
                    'correo' => $estudiante->correo,
                    'telefono' => $estudiante->telefono,
                    'nota' => null,
                    'detalles' => null,
                ]);
            }
        }
        return $inscritosAndNotas;
    }


    // static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    // {
    //     $estudiantes = Estudiante::orWhere('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orWhere('apellido', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orWhere('honorifico', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orWhere('ci', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orWhere('telefono', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orWhere('correo', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orWhere('carrera', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orWhere('universidad', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orWhere('nacionalidad', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orWhere('sexo', 'ILIKE', '%' . strtolower($attribute) . '%')
    //         ->orderBy('id', $order)
    //         ->paginate($paginate);
    //     return $estudiantes;
    // }
}
