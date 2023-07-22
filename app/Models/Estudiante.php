<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = [
        'honorifico',
        'nombre',
        'apellido',
        'ci',
        'ci_expedicion',
        'telefono',
        'correo',
        'carrera',
        'universidad',
        'estado',
        'sexo',
        'nacionalidad',
        'fecha_inactividad',
    ];
    protected $table = 'estudiante';

    // Asociaciones


    // Funciones
    static public function CreateEstudiante(array $data)
    {
        $new = new Estudiante($data);
        $new->save();
        return $new;
    }

    static public function UpdateEstudiante(Estudiante $estudiante, array $data)
    {
        $estudiante->update($data);
        return $estudiante;
    }

    static public function DeleteEstudiante(Estudiante $estudiante)
    {
        $estudiante->delete();
        return $estudiante;
    }

    static public function GetEstudiante(int $id)
    {
        return Estudiante::find($id);
    }

    static public function GetEstudiantes()
    {
        return Estudiante::all();
    }

    static public function estado(Estudiante $estudiante, $estado)
    {
        $estudiante->estado = $estado;
        if ($estado === "Abandono")
            $estudiante->fecha_inactividad = date('Y-m-d');
        else
            $estudiante->fecha_inactividad = null;
        $estudiante->save();
        return $estudiante;
    }

    static public function GetAllSearch($attribute, $order = 'desc', $paginate)
    {
        $estudiantes = Estudiante::orWhere('nombre', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('apellido', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('honorifico', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('ci', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('telefono', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('correo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('carrera', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('universidad', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('nacionalidad', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('sexo', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $estudiantes;
    }
}
