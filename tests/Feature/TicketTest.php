<?php

namespace Tests\Feature;

use App\Livewire\HomePage;
use App\Models\Category\Category;
use App\Models\Ticket\Ticket;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use RefreshDatabase;
    public function test_modal_create_ticket()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $ticket = Livewire::test(HomePage::class)
        ->call('confirmTicketAdd')
        ->assertStatus(200);
    }
    public function test_authenticated_user_can_create_ticket()
    {
        $categoryId = \DB::table('categories')->insertGetId([
            'name' => 'Suporte Técnico',
            'color' => '#F00000',
        ]);
        $userRole = Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web',
        ]);

        $user = User::factory()->create();
        $user->assignRole($userRole);
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
            'user_id' => $user->id,
        ]);
    }
    public function test_modal_edit_ticket()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $ticket = Livewire::test(HomePage::class)
        ->call('confirmTicketEdit')
        ->assertStatus(200);
    }
    public function test_authenticated_user_can_edit_ticket()
    {
        $categoryId = \DB::table('categories')->insertGetId([
            'name' => 'Suporte Técnico',
            'color' => '#F00000',
        ]);
        $userRole = Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web',
        ]);

        $user = User::factory()->create();
        $user->assignRole($userRole);
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
            'user_id' => $user->id,
        ]);

        $ticket = $edited = [
            'subject' => 'Editado',
            'description' => 'Editado',
            'priority' => '1',
            'status' => '0',
            'category_id' => $categoryId,
        ];
        $this->assertSame($edited, $ticket);
    }
    public function test_toggles_ticket_status()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $category = Category::factory()->create();

        $ticket = Livewire::test('HomePage')
            ->set('subject', 'Erro ao logar')
            ->set('description', 'Aparece erro 403 ao tentar logar')
            ->set('priority', '0')
            ->set('status', '1')
            ->set('category_id', $category->id)
            ->set('user_id', $user->id)
            ->call('submit');

        $ticket->call('toggleStatus',$ticket->id);
        // dd($ticket->status);
        $this->assertEquals('1', $ticket->status);
    }
    public function test_delete_ticket()
    {
        $categoryId = \DB::table('categories')->insertGetId([
            'name' => 'Suporte Técnico',
            'color' => '#F00000',
        ]);

        $permisison = Permission::firstOrCreate([
            'name' => 'delete-ticket',
            'guard_name' => 'web',
        ]);

        $userRole = Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web',
        ]);

        $userRole->syncPermissions([$permisison]);

        $user = User::factory()->create();
        $user->assignRole($userRole);
        $this->actingAs($user);

        $tickets = Livewire::test('HomePage')
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
            'user_id' => $user->id,
        ]);
        
        $ticket = Ticket::where('subject', 'Erro ao logar')->firstOrFail();
        $tickets->call('confirmTicketDeletion', $ticket->id);
                
        $this->assertDatabaseCount('tickets','0');
    }
    public function test_displays_paginated_tickets()
    {
        $category = Category::factory()->create();

        $user = User::factory()->create();
        $this->actingAs($user);

        $ticket = Ticket::factory()->count(15)->create();

        Livewire::test(HomePage::class)
            ->assertViewHas('adm_tickets', function($adm_tickets){
                return $adm_tickets->count() === 10;
            });
    }
    public function test_displays_second_page_correctly()
    {
        $category = Category::factory()->create();

        $user = User::factory()->create();
        $this->actingAs($user);

        $ticket = Ticket::factory()->count(15)->create();

        Livewire::test(HomePage::class)
            ->call('gotoPage', 2) 
            ->assertViewHas('adm_tickets', function($adm_tickets){
                return $adm_tickets->count() === 5;
            });
    }
}
