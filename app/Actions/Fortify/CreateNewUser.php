<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {
        $permissions = [
            'show-user',
            'create-ticket',
            'edit-ticket',
            'delete-ticket',
            'delete-user-comment',
            'edit-user-comment',
        ];

        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        $userRole->syncPermissions([
            'create-ticket',
            'edit-ticket',
            'delete-ticket',
            'edit-user-comment',
        ]);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        $user->assignRole($userRole);
        
        return $user;
    }
}
