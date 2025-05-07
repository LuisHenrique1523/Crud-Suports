<?php

namespace App\Livewire;

use App\Models\Comemntary\Commentary;
use App\Models\Ticket\Ticket;
use Livewire\Component;

class CommentariesCreate extends Component
{
    public $content;
    public $ticket_id;
    public Ticket $tickets;
    public function submit()
    {
        $comentary = new Commentary;
        $comentary->user_id = auth()->id();
        $comentary->content = $this->content;
        $comentary->ticket_id = $this->ticket_id;
        $comentary->save();
        
        return redirect('/comments');
    }
    public function render()
    {
        $ticket = auth()->user()->tickets;
        $tic = Ticket::query()
        ->when(
            'is not admin', 
            fn($q) => $q->where('user_id', auth()->id())
        )
        ->get();
        return view('livewire.commentaries-create',compact('ticket','tic'));
    }
}
