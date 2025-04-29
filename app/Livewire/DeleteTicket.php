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
        session()->flash('success','Ticket deletado com sucesso!');
        
        if(!$this->ticket->delete()){
        session()->flash('error','Não é possível deletar um ticket em uso');
        return redirect('/home');
        }

        $this->dispatch('TicketDeleted');
        return redirect('/home');
    }

    public function render()
    {
        return view('livewire.ticket-delete');
    }
}
