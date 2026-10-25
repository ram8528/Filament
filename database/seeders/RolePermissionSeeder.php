<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'view employees',
            'create employees',
            'update employees',
            'delete employees',
            'manage departments',
            'manage designations',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $hr = Role::firstOrCreate([
            'name' => 'hr-manager',
            'guard_name' => 'web',
        ]);

        $employee = Role::firstOrCreate([
            'name' => 'employee',
            'guard_name' => 'web',
        ]);

        $admin->syncPermissions($permissions);

        $hr->syncPermissions([
            'view employees',
            'create employees',
            'update employees',
            'manage departments',
            'manage designations',
        ]);

        $employee->syncPermissions([
            'view employees',
        ]);
    }
}
