<?php

use Illuminate\Database\Seeder;

use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Permiso de usuario
        Permission::create([
            'name' => 'Navegar usuarios',
            'slug' => 'users.index',
            'description' => 'Lista y navega todos los usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle de usuario',
            'slug' => 'users.ver',
            'description' => 'Ver en detalle cada usuario del sistema',
        ]);
        Permission::create([
            'name' => 'Edición de usuario',
            'slug' => 'users.editar',
            'description' => 'Editar cualquier dato de un usuario del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar usuario',
            'slug' => 'users.eliminar',
            'description' => 'Eliminar cualquier usuario del sistema',
        ]);

        // Permisos de items  
        Permission::create([
            'name' => 'Navegar items',
            'slug' => 'items.index',
            'description' => 'Lista y navega todos los items del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle de item',
            'slug' => 'items.ver',
            'description' => 'Ver en detalle cada item del sistema',
        ]);
        Permission::create([
            'name' => 'Creación de item',
            'slug' => 'items.crear',
            'description' => 'Crear cualquier dato de un itemdel sistema',
        ]);
        Permission::create([
            'name' => 'Edición de item',
            'slug' => 'items.editar',
            'description' => 'Editar cualquier dato de un itemdel sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar item',
            'slug' => 'items.eliminar',
            'description' => 'Eliminar cualquier item del sistema',
        ]);

        //Roles
        Permission::create([
            'name' => 'Navegar roles',
            'slug' => 'roles.index',
            'description' => 'Lista y navega todos los roles del sistema',
        ]);
        Permission::create([
            'name' => 'Ver detalle de roles',
            'slug' => 'roles.ver',
            'description' => 'Ver en detalle cada roles del sistema',
        ]);
        Permission::create([
            'name' => 'Edición de roles',
            'slug' => 'roles.crear',
            'description' => 'Crear dato de un roles en el sistema',
        ]);
        Permission::create([
            'name' => 'Edición de roles',
            'slug' => 'roles.editar',
            'description' => 'Editar cualquier dato de un rol del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar rol',
            'slug' => 'roles.eliminar',
            'description' => 'Eliminar cualquier roles del sistema',
        ]);
    }
}
