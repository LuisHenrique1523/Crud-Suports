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
            'show-user',
            'create-ticket',
            'create-reply',
            'edit-ticket',
            'edit-ticket-priority',
            'finish-ticket',
            'delete-ticket',
            'delete-comment',
            'delete-user-comment',
            'edit-user-comment',
        ];
        
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        $adminRole->syncPermissions([
            'show-all',
            'create-reply',
            'edit-ticket-priority',
            'finish-ticket',
            'delete-comment',
        ]);
    
        $userRole->syncPermissions([
            'show-user',
            'create-ticket',
            'edit-ticket',
            'delete-ticket',
            'delete-user-comment',
            'edit-user-comment',
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin001'),
            'role_as' => '1',
        ]);
        $admin->assignRole($adminRole);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'role_as' => '0',
        ]);
        $user->assignRole($userRole);
    }
}
