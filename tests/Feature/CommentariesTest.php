<?php

namespace Tests\Feature;

use App\Livewire\Commentaries;
use App\Models\Category\Category;
use App\Models\Commentary\Commentary;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CommentariesTest extends TestCase
{
    use RefreshDatabase;
    public function test_modal_create_commentary()
    {
        Livewire::test(Commentaries::class)
        ->call('confirmCommentAdd')
        ->assertStatus(200);
    }
    public function test_create_commentary()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user);

        $category = Category::factory()->create();

        $ticket = Ticket::factory()->create();

        Livewire::test(Commentaries::class,['ticketID' => $ticket->id])
            ->set('user_id', $user->id)
            ->set('ticket_id', $ticket->id)
            ->set('content', 'Cubo')
            ->call('submit');

        $commentary = Commentary::where('content', 'Cubo')->first();

        $this->assertNotNull($commentary);
        $this->assertEquals($user->id, $commentary->user_id);
        $this->assertEquals($ticket->id, $commentary->ticket_id);
    }
    public function test_modal_edit_commentary()
    {
        Livewire::test(Commentaries::class)
        ->call('confirmCommentEdit')
        ->assertStatus(200);
    }
    public function test_edit_commentary()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user);

        $category = Category::factory()->create();

        $ticket = Ticket::factory()->create();

        Livewire::test(Commentaries::class,['ticketId' => $ticket->id])
            ->set('user_id', $user->id)
            ->set('ticket_id', $ticket->id)
            ->set('content', 'Cubo')
            ->call('submit');

        $commentary = Commentary::where('content', 'Cubo')->first();
        
        $commentary = $edited = [
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
            'content' => 'Editado',
        ];

        $this->assertSame($edited, $commentary);
    }
    public function test_delete_commentary()
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

        $commentaries = Livewire::test(Commentaries::class,['ticketId' => $ticket->id])
            ->set('user_id', $user->id)
            ->set('ticket_id', $ticket->id)
            ->set('content', 'Cubo')
            ->call('submit');

            $this->assertDatabaseHas('commentaries', [
                'user_id' => $user->id,
                'ticket_id' => $ticket->id,
                'content' => 'Cubo',
            ]);

        $commentary = Commentary::where('content', 'Cubo')->first();
        $commentaries->call('confirmCommentDeletion', $commentary->id);

        $this->assertDatabaseCount('commentaries','0');

    }
}
