<?php

namespace App\Livewire;

use App\Models\Ticket\Ticket;
use Livewire\Component;

class DeleteTicket extends Component
{
    public $ticket;

    public function mount($id)
    {
        $this->ticket = Ticket::find($id);
    }

    public function DeleteTicket()
    {
        if(!$this->ticket) {
            session()-> flash('error', 'Ticket não encontrado!');
            return;
        }

        $this->ticket->delete();

        session()-> flash('success', 'Ticket removido com sucesso!');
        
        $this->dispatch('TicketDeleted');
    }
    public function render()
    {
        return view('livewire.ticket-delete');
    }
}
