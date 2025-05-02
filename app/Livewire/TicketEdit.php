<?php

namespace App\Livewire;

use App\Models\Category\Category;
use Livewire\Component;
use App\Models\Ticket\Ticket;

class TicketEdit extends Component
{
    public $subject;
    public $description;
    public Ticket $ticket;
    public $categories;
    public $category_id;
    public $tickets;
    public $priority;

    protected $rules = [
        'subject' => 'required',
        'description' => 'required',
        'category_id' => 'required',
        'priority' => 'required',
    ];

    public function mount($ticket)
    {
        $this->subject = $ticket->subject;
        $this->description = $ticket->description;
        $this->category_id = $ticket->category_id;
        $this->priority = $ticket->priority;

        $this->categories = Category::all();
        $this->tickets = Ticket::all();
    }
    public function ticketEdit()
    {
        $validated = $this->validate([
            'subject' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'priority' => 'required',
        ]);
        $this->ticket->update($validated);
        
        return redirect()->to('/home');
    }
    public function render()
    {
        return view('livewire.ticket-edit');
    }
}
