<?php

namespace App\Http\Livewire\Academico\Modulo;

use App\Models\Estudiante;
use App\Models\EstudianteNota;
use App\Models\EstudiantePrograma;
use App\Models\Modulo;
use Livewire\Component;

class NewNota extends Component
{
    public $modulo;
    public $estudiantes;
    public $inscritos = [];
    public $notas = [];
    public $detalles = [];
    public $errorValidation = false;
    public $idError;
    public $mensaje;

    public function mount(Modulo $modulo)
    {
        $this->modulo = $modulo;
        $this->inscritos = EstudiantePrograma::GetInscritosAndNotas($modulo->programa_id);
        foreach ($this->inscritos as $inscrito) {
            $this->notas[$inscrito['estudiante']] = $inscrito["nota"];
            $this->detalles[$inscrito['estudiante']] = $inscrito["detalles"];
        }
    }

    public function save()
    {
        $this->errorValidation = false;
        foreach ($this->notas as $key => $value) {
            if (!is_numeric($value) || $value < 0 || $value > 100) {
                $this->errorValidation = true;
                $this->idError = $key;
                $this->mensaje = "El campo nota debe ser un numero entre 0 y 100";
                return;
            }
        }
        foreach ($this->notas as $key => $nota) {
            if ($nota == "") continue;
            $estudiante_nota = EstudianteNota::getNotaByEstudianteAndModulo($key, $this->modulo->id);
            if (!$estudiante_nota) {
                EstudianteNota::CreateEstudianteNota([
                    'nota' => $nota,
                    'detalles' => $this->detalles[$key] ?? "",
                    'programa_id' => $this->modulo->programa_id,
                    'estudiante_id' => $key,
                    'modulo_id' => $this->modulo->id
                ]);
            } else {
                // dd($estudiante_nota, $nota, $this->detalles[$key] ?? "");
                EstudianteNota::UpdateEstudianteNota($estudiante_nota, [
                    'nota' => $nota,
                    'detalles' => $this->detalles[$key] ?? "",
                ]);
            }
        }
        return redirect()->route('modulo.show', $this->modulo->id);
    }

    public function render()
    {
        return view('livewire.academico.modulo.new-nota')
            ->layout('layouts.adulto');
    }
}
