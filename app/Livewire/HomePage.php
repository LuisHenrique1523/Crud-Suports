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
        $this->tickets = Ticket::all();   
    }
    public function render(Ticket $ticket)
    {
        $supports = auth()->user()->tickets;
        $tickets = $ticket->orderByDesc('priority')->paginate(1);
        return view('livewire.home-page',compact('tickets','supports'));
    }
}
