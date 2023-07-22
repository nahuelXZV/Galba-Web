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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // \App\Models\User::factory(10)->create();
        $admin = Role::create(['name' => 'Administrador']);

        //Permisos
        // Permission::create(['name' => 'usuarios', 'description' => 'Gestionar Usuarios'])->syncRoles($admin);
        // Permission::create(['name' => 'roles', 'description' => 'Gestionar Roles'])->syncRoles($admin);
        // Permission::create(['name' => 'ingredientes', 'description' => 'Gestionar Ingredientes'])->syncRoles($admin);
        // Permission::create(['name' => 'productos', 'description' => 'Gestionar Productos'])->syncRoles($admin);
        // Permission::create(['name' => 'recetas', 'description' => 'Gestionar Recetas'])->syncRoles($admin);
        // Permission::create(['name' => 'proveedores', 'description' => 'Gestionar Proveedores'])->syncRoles($admin);
        // Permission::create(['name' => 'compras', 'description' => 'Gestionar Compras'])->syncRoles($admin);
        // Permission::create(['name' => 'pedidos', 'description' => 'Gestionar Pedidos'])->syncRoles($admin);
        // Permission::create(['name' => 'cocina', 'description' => 'Gestionar Estado En La Cocina'])->syncRoles($admin);
        // Permission::create(['name' => 'eliminar', 'description' => 'Puede Eliminar Los Datos'])->syncRoles($admin);
        // Permission::create(['name' => 'reportes', 'description' => 'Descargar Reportes'])->syncRoles($admin);
        // Permission::create(['name' => 'pantalla', 'description' => 'Mostrar La Pantalla Del Cliente'])->syncRoles($admin);

        User::create([
            'name' => 'Test User',
            'email' => 'example@live.com',
            'password' => bcrypt('12345678'),
            'area' => 'Sistemas',
        ])->assignRole('Administrador');
    }
}
