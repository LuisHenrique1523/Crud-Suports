<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
    public function test_unauthenticated_user_cannot_access_home_page(): void
    {
        $response = $this->get(route('home'));


        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    public function test_login_redirect_to_other_page()
    {
        $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/home');

    $response->assertStatus(200);
    }
    public function test_user_can_access_any_page()
    {
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);

        $user = User::factory()->create();
        $user->assignRole($superadminRole);
    $response = $this->actingAs($user)->get('/users');

    $response->assertStatus(200);
    }
    public function test_operator_user_cannot_access_protected_routes()
    {
        $operatorRole = Role::firstOrCreate(['name' => 'operator']);

        $user = User::factory()->create();
        $user->assignRole($operatorRole);
    $response = $this->actingAs($user)->get('/users');
    
    $response->assertStatus(403);
    }
    public function test_common_user_cannot_access_protected_routes()
    {
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $user = User::factory()->create();
        $user->assignRole($userRole);
    $response = $this->actingAs($user)->get('/permissions');

    $response->assertStatus(403);
    }
}
