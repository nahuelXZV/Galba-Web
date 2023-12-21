<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pagina;
use App\Models\User;
use App\Models\Usuario;
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
        $public = Role::create(['name' => 'Publico']);

        //Permisos
        Permission::create(['name' => 'usuarios', 'description' => 'Gestionar Usuarios'])->syncRoles($admin);
        Permission::create(['name' => 'roles', 'description' => 'Gestionar Roles'])->syncRoles($admin);
        Permission::create(['name' => 'pedidos', 'description' => 'Gestionar Pedidos'])->syncRoles($admin);
        Permission::create(['name' => 'compras', 'description' => 'Gestionar Compras'])->syncRoles($admin);
        Permission::create(['name' => 'proveedores', 'description' => 'Gestionar Proveedores'])->syncRoles($admin);
        Permission::create(['name' => 'ingresos', 'description' => 'Gestionar Ingresos'])->syncRoles($admin);
        Permission::create(['name' => 'salidas', 'description' => 'Gestionar Salidas'])->syncRoles($admin);
        Permission::create(['name' => 'productos', 'description' => 'Gestionar Productos'])->syncRoles($admin);

        //Paginas
        Pagina::create(['nombre' => 'Dashboard', 'ruta' => 'dashboard', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Usuarios', 'ruta' => 'usuario.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nuevo Usuario', 'ruta' => 'usuario.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Editar Usuario', 'ruta' => 'usuario.edit', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Roles', 'ruta' => 'rol.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nuevo Rol', 'ruta' => 'rol.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Editar Rol', 'ruta' => 'rol.edit', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Pedidos', 'ruta' => 'pedido.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nuevo Pedido', 'ruta' => 'pedido.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Ver Pedido', 'ruta' => 'pedido.show', 'visitas' => 0]);



        // Paginas publicas
        Pagina::create(['nombre' => 'Inicio', 'ruta' => 'inicio', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Lista de Producto', 'ruta' => 'public.producto.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Detalle de Producto', 'ruta' => 'public.producto.show', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Carrito', 'ruta' => 'public.carrito', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Confirmar Pedido', 'ruta' => 'public.confirm_pedido', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Acerca de', 'ruta' => 'public.acerca_de', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Contacto', 'ruta' => 'public.contacto', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Perfil', 'ruta' => 'public.perfil', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Lista de Pedidos', 'ruta' => 'public.pedido', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Detalle de Pedido', 'ruta' => 'public.pedido.show', 'visitas' => 0]);


        //Usuarios
        User::create([
            'name' => 'Test User',
            'email' => 'example@live.com',
            'password' => bcrypt('12345678'),
            'direccion' => 'calle falsa 123',
            'telefono' => '123456789',
            'cargo' => 'Administrador',
            'es_cliente' => true,
            'es_personal' => true,
            'es_administrador' => true,
        ])->assignRole('Administrador');
        User::create([
            'nombre' => 'nahuel zalazar',
            'correo' => 'daniela.carrasco@nahuelxzv.pro',
            'contraseña' => bcrypt('12345678'),
            'direccion' => 'calle falsa 123',
            'telefono' => '123456789',
            'cargo' => 'Administrador',
            'es_cliente' => true,
            'es_personal' => false,
            'es_administrador' => false,
        ]);
    }
}
