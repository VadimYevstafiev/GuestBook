<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach(config('custom.permissions') as $permission) {
            Permission::findOrCreate($permission);
        }

        foreach(config('custom.roles') as $item) {
            $role = Role::create(['name' => $item]);
            $role->givePermissionTo(Permission::all());
        }

        // $role = Role::create(['name' => 'user']);
        // $role->givePermissionTo(Permission::all());

        // $role = Role::create(['name' => 'admin']);
        // $role->givePermissionTo(Permission::all());
    }
}
