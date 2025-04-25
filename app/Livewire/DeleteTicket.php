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
        try{
            if(!$this->ticket->delete()){
                throw new \Exception('Não é possivel deletar um ticket em uso',1);
            }
        }catch(\Exception $e){
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
