<?php

namespace App\Livewire;

use App\Models\RepliesTickets;
use App\Models\Ticket\Ticket;
use Livewire\Component;

use function Laravel\Prompts\select;

class Replies extends Component
{
    public $replyRecord = [];
    public $replies;
    public $reply;
    public $ticket;
    public function replies(Ticket $tickets) 
    {
        $this->ticket = $tickets;
    }
    public function mount($replyRecord)
    {
        $this->replyRecord = $replyRecord;
    }
    public function submit()
    {
        $reply = new RepliesTickets;
        $reply->user_id = auth()->id();
        $reply->ticket_id = $this->replyRecord;
        $reply->reply = $this->replies;
        // dd($reply);
        $reply->save();
    }
    public function render(Ticket $ticket)
    { 
        $this->reply = RepliesTickets::all();
        return view('livewire.replies');
    }
}
