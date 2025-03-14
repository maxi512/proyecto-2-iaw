<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'update songs']);
        Permission::create(['name' => 'update artists']);
        Permission::create(['name' => 'update albums']);

        Permission::create(['name' => 'delete songs']);
        Permission::create(['name' => 'delete artists']);
        Permission::create(['name' => 'delete albums']);

        Permission::create(['name' => 'update users']);

        $role = Role::create(['name' => 'Fan']);

        $role = Role::create(['name' => 'Editor']);
        $role->givePermissionTo('update songs');
        $role->givePermissionTo('update artists');
        $role->givePermissionTo('update albums');
        $role->givePermissionTo('delete albums');
        $role->givePermissionTo('delete artists');
        $role->givePermissionTo('delete songs');

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(Permission::all());
    
    }
}
