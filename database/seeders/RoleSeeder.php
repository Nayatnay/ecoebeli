<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Cliente']);

        Permission::create(['name' => 'tienda'])->syncRoles([$role1, $role2]);
        /*
        Permission::create(['name' => 'verproductos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'detalproducto'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'buscar'])->syncRoles([$role1, $role2]);
*/
        Permission::create(['name' => 'admintienda'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admincom'])->syncRoles([$role1, $role2]);

        /*        
        Permission::create(['name' => 'carro'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'condiciones'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'politicas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'dashboard'])->syncRoles([$role1, $role2]);
*/
        //solo administradores
        Permission::create(['name' => 'admincat'])->syncRoles([$role1]);
        Permission::create(['name' => 'adminsubcat'])->syncRoles([$role1]);
        Permission::create(['name' => 'adminpro'])->syncRoles([$role1]);
        Permission::create(['name' => 'tasa'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'categoria_delete'])->syncRoles([$role1]);
        Permission::create(['name' => 'categorias'])->syncRoles([$role1]);
        Permission::create(['name' => 'productos'])->syncRoles([$role1]);
        
        /*
        // carrito
        Permission::create(['name' => 'add'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'adicion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clear'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'removeitem'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'updateqty'])->syncRoles([$role1, $role2]);
*/
        // compra
        Permission::create(['name' => 'compra'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'verificalog'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'adicompra'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'editmedio'])->syncRoles([$role1, $role2]);
    }
}
