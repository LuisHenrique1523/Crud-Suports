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
        $this->ticket->delete();

        session()-> flash('success', 'Ticket removido com sucesso!');

        $this->dispatch('TicketDeleted');

        session()-> flash('error', 'Ticket não encontrado!');
        return;
    }

    public function render()
    {
        return view('livewire.ticket-delete');
    }
}
