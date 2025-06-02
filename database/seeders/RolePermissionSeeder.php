<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'show-all',
            'create-ticket',
            'edit-ticket',
            'edit-ticket-priority',
            'finish-ticket',
            'delete-ticket',
            'create-reply',
            'pagination',

            'access-operations',
            'operations',
        ];
        
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);
        $operatorRole = Role::firstOrCreate(['name' => 'operator']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $operatorRole->syncPermissions([
            'show-all',
            'edit-ticket-priority',
            'finish-ticket',
            'create-reply',
            'pagination',
            'access-operations', 
            'operations',
        ]);

        $userRole->syncPermissions([
            'create-ticket',
            'edit-ticket',
            'delete-ticket',
        ]);

        $superadmin = User::firstOrCreate([
            'email' => 'superadmin@gmail.com'
        ], [
            'name' => 'SuperAdmin',
            'password' => Hash::make('admin001'),
            'role_as' => '2',
        ]);
        $superadmin->assignRole($superadminRole);

        $operator = User::firstOrCreate([
            'email' => 'operator@gmail.com'
        ], [
            'name' => 'Operator',
            'password' => Hash::make('operator'),
            'role_as' => '1',
        ]);
        $operator->assignRole($operatorRole);

        $user = User::firstOrCreate([
            'email' => 'user@gmail.com'
        ], [
            'name' => 'User',
            'password' => Hash::make('12345678'),
            'role_as' => '0',
        ]);
        $user->assignRole($userRole);
    }
}