<?php

namespace App\Livewire;

use App\Models\Category\Category;
use App\Models\Ticket\Ticket;
use Livewire\{Component};

class ShowPage extends Component
{ 
    public $getRecord = [];
    public $tickets;
    public function mount($id)
    {
        $this->getRecord = Ticket::find($id);
        $categories = Category::all();
    }
        public function render(Ticket $ticket)
    {
        // $tickets = $ticket->orderBy('priority')->paginate(10);
        // $tickets = ticket::all();
        return view('livewire.show-page');
    }
}
