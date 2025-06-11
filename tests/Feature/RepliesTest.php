<?php

namespace Tests\Feature;

use App\Livewire\Replies;
use App\Models\Category\Category;
use App\Models\Reply;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RepliesTest extends TestCase
{
    use RefreshDatabase;
    public function test_modal_create_reply()
    {
        Livewire::test(name:Replies::class)
        ->call('confirmReplyAdd')
        ->assertStatus(200);
    }
    public function test_create_reply()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user);

        $category = Category::factory()->create();

        $ticket = Ticket::factory()->create();

        Livewire::test(Replies::class,['ticketID' => $ticket->id, 'ticketUserID' => $ticket->user_id])
            ->set('user_id', $user->id)
            ->set('ticket_id', $ticket->id)
            ->set('ticket_creator', $ticket->user_id)
            ->set('reply', 'Resposta')
            ->call('submit');
    
        $reply = Reply::where('reply', 'Resposta')->first();

        $this->assertNotNull($reply);
        $this->assertEquals($user->id, $reply->user_id);
        $this->assertEquals($ticket->id, $reply->ticket_id);
        $this->assertEquals($ticket->user_id, $reply->ticket_creator);
    }
    public function test_modal_edit_reply()
    {
        Livewire::test(Replies::class)
        ->call('confirmReplyEdit')
        ->assertStatus(200); 
    }
    public function test_edit_reply()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user);

        $category = Category::factory()->create();

        $ticket = Ticket::factory()->create();

        Livewire::test(Replies::class,['ticketID' => $ticket->id, 'ticketUserID' => $ticket->user_id])
            ->set('user_id', $user->id)
            ->set('ticket_id', $ticket->id)
            ->set('ticket_creator', $ticket->user_id)
            ->set('reply', 'Resposta')
            ->call('submit');
    
        $reply = Reply::where('reply', 'Resposta')->first();
        
        $reply = $edited = [
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
            'ticket_creator' => $ticket->user_id,
            'reply' => 'Editada',
        ];

        $this->assertSame($edited, $reply);
    }
    public function test_delete_reply()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user);

        $category = Category::factory()->create();

        $ticket = Ticket::factory()->create();

        $replies = Livewire::test(Replies::class,['ticketId' => $ticket->id, 'ticketUserID' => $ticket->user_id])
            ->set('user_id', $user->id)
            ->set('ticket_id', $ticket->id)
            ->set('ticket_creator', $ticket->user_id)
            ->set('reply', 'Resposta')
            ->call('submit');

            $this->assertDatabaseHas('replies_ticket', [
                'user_id' => $user->id,
                'ticket_id' => $ticket->id,
                'ticket_creator' => $ticket->user_id,
                'reply' => 'Resposta',
            ]);

            $reply = Reply::where('reply', 'Resposta')->first();

            $replies->call('confirmReplyDeletion', $reply->id);

        $this->assertDatabaseMissing('replies_ticket', [
        'id' => $reply->id,
        ]);
    }
}
