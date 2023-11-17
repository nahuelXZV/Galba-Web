<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pagina;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Administrador']);

        //Permisos
        Permission::create(['name' => 'usuarios', 'description' => 'Gestionar Usuarios'])->syncRoles($admin);
        Permission::create(['name' => 'roles', 'description' => 'Gestionar Roles'])->syncRoles($admin);

        //Paginas
        Pagina::create(['nombre' => 'Inicio', 'ruta' => 'inicio', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Dashboard', 'ruta' => 'dashboard', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Usuarios', 'ruta' => 'usuario.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nuevo Usuario', 'ruta' => 'usuario.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Editar Usuario', 'ruta' => 'usuario.edit', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Roles', 'ruta' => 'rol.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nuevo Rol', 'ruta' => 'rol.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Editar Rol', 'ruta' => 'rol.edit', 'visitas' => 0]);


        //Usuarios
        User::create([
            'name' => 'Test User',
            'email' => 'example@live.com',
            'password' => bcrypt('12345678'),
            'area' => 'Sistemas',
        ])->assignRole('Administrador');
    }
}
