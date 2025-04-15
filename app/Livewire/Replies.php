<?php

namespace App\Livewire;

use App\Models\RepliesTickets;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Livewire\Component;

use function Laravel\Prompts\select;

class Replies extends Component
{
    public $rep;
    public Ticket $ticket;
    public function submit()
    {
        $reply = new RepliesTickets;
        $reply->user_id = auth()->id();
        $reply->ticket_id = $this->ticket->id;
        $reply->reply = $this->rep;
        $reply->save();
    }
    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function render()
    {   
        return view('livewire.replies');
    }
}
