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
    public $category;
    public $categories;
    public $category_id;
    public $tickets;

    protected $rules = [
        'subject' => 'required',
        'description' => 'required',
        'category_id' => 'required'
    ];

    public function mount(Ticket $ticket)
    {
        // $this->id = $ticket->id;
        $this->subject = $ticket->subject;
        $this->description = $ticket->description;
        // $this->priority = $ticket->priority;
        // $this->status = $ticket->status;
        $this->category_id = $ticket->category_id;

        $this->categories = Category::all();
        $this->tickets = Ticket::all();
    }
    public function ticketEdit()
    {
        $validated = $this->validate([
            'subject' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);
        
        $this->ticket->update($validated);
        
        return redirect()->to('/home');
    }
    public function render()
    {
        return view('livewire.ticket-edit');
    }
}
