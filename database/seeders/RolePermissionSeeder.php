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
            
            'comment-action',
            'delete-user-comment',
            'edit-user-comment',

            'access-operations',
            'reply-operations',
        ];
        
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);
        $operatorRole = Role::firstOrCreate(['name' => 'operator']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $operatorRole->syncPermissions([
            'show-all',
            'create-reply',
            'edit-ticket-priority',
            'finish-ticket',
            'comment-action',
            'access-operations', 
            'pagination',
            'reply-operations',
        ]);
    
        $userRole->syncPermissions([
            'create-ticket',
            'edit-ticket',
            'delete-ticket',
            'delete-user-comment',
            'edit-user-comment',
        ]);

        $superadmin = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('admin001'),
            'role_as' => '2',
        ]);
        $superadmin->assignRole($superadminRole);

        $operator = User::create([
            'name' => 'Operator',
            'email' => 'operator@gmail.com',
            'password' => Hash::make('operator'),
            'role_as' => '1',
        ]);
        $operator->assignRole($operatorRole);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'role_as' => '0',
        ]);
        $user->assignRole($userRole);
    }
}
