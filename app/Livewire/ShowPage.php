<?php

namespace App\Livewire;

use App\Models\Category\Category;
use App\Models\Ticket\Ticket;
use Livewire\{Component,WithPagination};

class ShowPage extends Component
{ 
    use WithPagination;
    protected $id;
    protected $categories;
    protected $tickets;
    // public function editticket($id)
    // {
    //     $ticket = Ticket::find($id);

    //     $this->id = $ticket->id;
    //     $this->user = $ticket->user
    // }
    public function mount($id)
    {
        $tickets = Ticket::where('id',$id)->first();
        $categories = Category::all();
        // dd($tickets);
    }
        public function render(Ticket $ticket)
    {
        $tickets = $ticket->orderByDesc('priority')->paginate(10);
        return view('livewire.show-page',compact('tickets'));
    }
}
