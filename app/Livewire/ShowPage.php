<?php

namespace App\Livewire;

use App\Models\Category\Category;
use App\Models\RepliesTickets;
use App\Models\Ticket\Ticket;
use Illuminate\Mail\Mailables\Content;
use Livewire\{Component};

class ShowPage extends Component
{ 
    public $replyRecord;
    public $reply;
    public $replies_ticket;
    public $getRecord = [];
    public $ticket;
    public function replies(Ticket $tickets) 
    {
        $this->ticket = $tickets;
    }
    public function mount($id)
    {
        $this->getRecord = Ticket::find($id);
        $categories = Category::all();
        $reply = RepliesTickets::all();
    }
        public function render()
    {
        $reply = RepliesTickets::all();
        return view('livewire.show-page',compact('reply'));
    }
}
