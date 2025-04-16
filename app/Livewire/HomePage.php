<?php

namespace App\Livewire;

use App\Models\Category\Category;
use App\Models\Ticket\Ticket;
use Livewire\{Component,WithPagination};

class HomePage extends Component
{
    use WithPagination;
    public $categories;
    public $tickets;
    public $listeners = ['TicketDeleted' => '$refresh'];
    public function mount()
    {
        $this->categories = Category::all();
    }
    public function update($ticketId)
    {
        $ticket = Ticket::find($ticketId);

        if($ticket){
            if($ticket->status){
                $ticket->status = 0;
            }
            else{
                $ticket->status = 1;
            }
            $ticket->save();
        }
        return back();
    }
    public function render(Ticket $tickets)
    {
        $supports = auth()->user()->tickets;
        $tick = $tickets->orderByDesc('priority')->paginate(10);
        return view('livewire.home-page',compact('tick','supports'));
    }
}
