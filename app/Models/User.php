<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tema',
        'area',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];


    // Funciones
    static public function CreateUsuario(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $new = new User();
        $new->name = $data['name'];
        $new->email = $data['email'];
        $new->area = $data['area'];
        $new->password = bcrypt($data['password']);
        $new->save();
        return $new;
    }

    static public function UpdateUsuario($id, array $data)
    {
        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->area = $data['area'];
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user;
    }

    static public function DeleteUsuario($id)
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }

    static public function GetUsuarios($attribute, $order = "desc", $paginate)
    {
        $users = User::where('name', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orWhere('email', 'ILIKE', '%' . strtolower($attribute) . '%')
            ->orderBy('id', $order)
            ->paginate($paginate);
        return $users;
    }

    static public function GetAllUsuarios()
    {
        $users = User::all();
        return $users;
    }

    static public function GetUsuario($id)
    {
        $user = User::find($id);
        return $user;
    }

    static public function cambiarTema(int $id, string $tema)
    {
        $user = User::find($id);
        $user->tema = $tema;
        $user->save();
        return $user;
    }
}
