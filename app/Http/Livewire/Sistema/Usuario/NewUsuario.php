<?php

namespace App\Http\Livewire\Sistema\Usuario;

use App\Models\Pagina;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class NewUsuario extends Component
{
    public $userArray = [];
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $listeners = ['store' => 'save'];
    public $layout;

    public $roles = [];
    public $areas = [
        "Sistemas",
        "Contable",
        "Administracion",
        "Gerencia",
    ];

    public function mount()
    {
        Pagina::UpdateVisita('usuario.new');
        $this->layout = auth()->user()->tema;
        $this->userArray = [
            'name' => '',
            'email' => '',
            'password' => '',
            'area' => '',
            'rol' => ''
        ];
        $this->roles = Role::all();
    }

    public function save()
    {
        $new = User::create($this->userArray);
        $new->assignRole($this->userArray['rol']);
        if (!$new) {
            $this->message = 'Error al crear el usuario';
            $this->type = 'error';
            $this->notificacion = true;
        }
        return redirect()->route('usuario.list');
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('usuario.new');
        return view('livewire.sistema.usuario.new-usuario', compact('visitas'))->layout($this->layout);
    }
}
