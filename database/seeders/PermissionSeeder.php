<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'roles.store']);
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'users.store']);
        Permission::create(['name' => 'users.show']);
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);

        $admin = Role::create(['name' => 'Administrator']);

        $admin->givePermissionTo([
            'roles.store',
            'roles.index',
            'users.store',
            'users.index',
            'users.create',
            'users.show'
        ]);

        $guest = Role::create(['name' => 'Guest']);

        $guest->givePermissionTo([
            'users.show'
        ]);
    }
}
