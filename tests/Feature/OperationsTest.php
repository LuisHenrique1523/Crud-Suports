<?php

namespace Tests\Feature;

use App\Livewire\Operations;
use App\Models\Category\Category;
use App\Models\Operation\Operation;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class OperationsTest extends TestCase
{
    use RefreshDatabase;
    public function test_modal_create_operation()
    {
        Livewire::test(Operations::class)
        ->call('confirmOperationAdd')
        ->assertStatus(200);
    }
    public function test_create_operation()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user);

        $category = Category::factory()->create();

        $ticket = Ticket::factory()->create();

        Livewire::test(Operations::class,['ticketId' => $ticket->id])
            ->set('user_id', $user->id)
            ->set('ticket_id', $ticket->id)
            ->set('description', 'Caixa')
            ->call('submit');
    
        $operation = Operation::where('description', 'Caixa')->first();

        $this->assertNotNull($operation);
        $this->assertEquals($user->id, $operation->user_id);
        $this->assertEquals($ticket->id, $operation->ticket_id);
    }
    public function test_modal_edit_operation()
    {
        Livewire::test(Operations::class)
        ->call('confirmOperationEdit')
        ->assertStatus(200);
    }
    public function test_edit_operation()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user);

        $category = Category::factory()->create();

        $ticket = Ticket::factory()->create();

        Livewire::test(Operations::class,['ticketId' => $ticket->id])
            ->set('user_id', $user->id)
            ->set('ticket_id', $ticket->id)
            ->set('description', 'Caixa')
            ->call('submit');

        $operation = Operation::where('description', 'Caixa')->first();
        
        $operation = $edited = [
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
            'description' => 'Editado',
        ];

        $this->assertSame($edited, $operation);
    }
    public function test_delete_operation()
    {
        $permisison = Permission::firstOrCreate([
            'name' => 'delete',
            'guard_name' => 'web',
        ]);

        $userRole = Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web',
        ]);

        $userRole->syncPermissions([$permisison]);
        
        $user = User::factory()->create();
        $user->assignRole($userRole);
        Livewire::actingAs($user);

        $category = Category::factory()->create();

        $ticket = Ticket::factory()->create();

        $operations = Livewire::test(Operations::class,['ticketId' => $ticket->id])
            ->set('user_id', $user->id)
            ->set('ticket_id', $ticket->id)
            ->set('description', 'Caixa')
            ->call('submit');

            $this->assertDatabaseHas('operations', [
                'user_id' => $user->id,
                'ticket_id' => $ticket->id,
                'description' => 'Caixa',
            ]);

        $operation = Operation::where('description', 'Caixa')->first();

        $operations->call('confirmOperationDeletion', $operation->id);
        $this->assertDatabaseCount('operations','0');

    }
}
