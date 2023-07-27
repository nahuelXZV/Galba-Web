<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        Permission::create(['name' => 'estudiantes', 'description' => 'Gestionar Estudiantes'])->syncRoles($admin);
        Permission::create(['name' => 'programas', 'description' => 'Gestionar Programas'])->syncRoles($admin);
        Permission::create(['name' => 'docentes', 'description' => 'Gestionar Docentes'])->syncRoles($admin);
        Permission::create(['name' => 'modulos', 'description' => 'Gestionar Modulos'])->syncRoles($admin);
        Permission::create(['name' => 'prospectos', 'description' => 'Gestionar Prospectos'])->syncRoles($admin);
        Permission::create(['name' => 'eventos', 'description' => 'Gestionar Eventos'])->syncRoles($admin);
        Permission::create(['name' => 'contratos', 'description' => 'Gestionar Contratos'])->syncRoles($admin);
        Permission::create(['name' => 'calendario', 'description' => 'Gestionar Calendario'])->syncRoles($admin);
        Permission::create(['name' => 'activos', 'description' => 'Gestionar Activos'])->syncRoles($admin);
        Permission::create(['name' => 'inventarios', 'description' => 'Gestionar Inventarios'])->syncRoles($admin);
        Permission::create(['name' => 'unidad', 'description' => 'Gestionar Unidades'])->syncRoles($admin);
        Permission::create(['name' => 'recepcion', 'description' => 'Gestionar Recepciones'])->syncRoles($admin);
        Permission::create(['name' => 'movimiento', 'description' => 'Gestionar Movimientos'])->syncRoles($admin);


        User::create([
            'name' => 'Test User',
            'email' => 'example@live.com',
            'password' => bcrypt('12345678'),
            'area' => 'Sistemas',
        ])->assignRole('Administrador');
    }
}
