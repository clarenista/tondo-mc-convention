<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Spatie 
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'manage user']);
        Permission::create(['name' => 'manage booth']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('manage user');

        $role2 = Role::create(['name' => 'sponsor']);
        $role2->givePermissionTo('manage booth');

        // create admin users
        $user = \App\Models\User::create([
            'first_name' => 'psp',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123'),

        ]);

        $user->assignRole($role1);
    }
}
