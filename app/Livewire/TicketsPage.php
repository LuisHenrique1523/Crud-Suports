<?php

namespace App\Livewire;

use App\Enums\Priority;
use Livewire\Component;
use App\Models\Category\Category;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;

class TicketsPage extends Component
{
    public $subject;
    public $description;
    public $categories;
    public $category_id;
    public $tickets;
    public $priority;
    protected $rules = [
        'subject' => 'required',
        'description' => 'required',
        'priority' => 'required',
        'category_id' => 'required'
    ];
    public function submit(Request $request)
    {
        $ticket = new Ticket;
        $ticket->user_id = auth()->id();
        $ticket->subject = $this -> subject;
        $ticket->description = $this->description;
        $ticket->priority = $this->priority;
        $ticket->status;
        $ticket->category_id = $this->category_id;
        $ticket-> save();

        return redirect()->to('home');
    }
    
    public function mount()
    {
        $this->priority = Priority::cases();
        $this->categories = Category::all();
        $this->tickets = Ticket::all();
    }
    public function render()
    {
        return view('livewire.tickets-page');
    }
}
