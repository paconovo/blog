<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Administrator']);
        $author = Role::create(['name' => 'Author']);

        Permission::create(['name' => 'admin.index',
                            'description' => 'Ver dashboard'])
                            ->syncRoles([$admin, $author]);

        //categorias
        Permission::create(['name' => 'categories.index',
                            'description' => 'Ver categorias'])
                            ->syncRoles([$admin, $author]);

        Permission::create(['name' => 'categories.create',
                            'description' => 'Crear categorias'])
                            ->assignRole($admin);

        Permission::create(['name' => 'categories.edit',
                            'description' => 'Editar categorias'])
                            ->assignRole($admin);

        Permission::create(['name' => 'categories.destroy',
                            'description' => 'Eliminar categorias'])
                            ->assignRole($admin);
        
        //Articulos
        Permission::create(['name' => 'articles.index',
                            'description' => 'Ver artículos'])
                            ->syncRoles([$admin, $author]);

        Permission::create(['name' => 'articles.create',
                            'description' => 'Crear articulos'])
                            ->syncRoles([$admin, $author]);

        Permission::create(['name' => 'articles.edit',
                            'description' => 'Editar artículos'])
                            ->syncRoles([$admin, $author]);

        Permission::create(['name' => 'articles.destroy',
                            'description' => 'Eliminar artículos'])
                            ->syncRoles([$admin, $author]);

        //Comentarios
        Permission::create(['name' => 'comments.index',
                            'description' => 'Ver comments'])
                            ->syncRoles([$admin, $author]);

        Permission::create(['name' => 'comments.destroy',
                            'description' => 'Eliminar comments'])
                            ->syncRoles([$admin, $author]);
        //Usuarios
        Permission::create(['name' => 'users.index',
                            'description' => 'Ver usuarios'])
                            ->assignRole($admin);
        
        Permission::create(['name' => 'users.edit',
                            'description' => 'Editar usuarios'])
                            ->assignRole($admin);

        Permission::create(['name' => 'users.destroy',
                            'description' => 'Eliminar usuarios'])
                            ->assignRole($admin);
    }
}
