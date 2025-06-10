<?php

namespace Tests\Feature;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use RefreshDatabase;
    public function test_authenticated_user_can_create_ticket()
{
    $this->refreshDatabase();

    $categoryId = \DB::table('categories')->insertGetId([
        'name' => 'Suporte Técnico',
        'color' => '#F00000',
    ]);
    $operatorRole = Role::firstOrCreate([
        'name' => 'operator',
        'guard_name' => 'web',
    ]);

    $user = User::factory()->create();
    $user->assignRole($operatorRole);
    $this->actingAs($user);

    $ticket = Livewire::test('HomePage')
        ->set('subject', 'Erro ao logar')
        ->set('description', 'Aparece erro 403 ao tentar logar')
        ->set('priority', '0')
        ->set('status', '1')
        ->set('category_id', $categoryId)
        ->call('submit')
        ->assertRedirect(route('home'));

    $this->assertDatabaseHas('tickets', [
        'subject' => 'Erro ao logar',
        'description' => 'Aparece erro 403 ao tentar logar',
        'priority' => '0',
        'status' => '1',
        'category_id' => $categoryId,
        'user_id' => $user->id
    ]);
}
}
