<?php

namespace App\Livewire;

use App\Enums\Priority;
use App\Models\Category\Category;
use App\Models\Ticket\Ticket;
use Livewire\{Component,WithPagination};

class HomePage extends Component
{
    use WithPagination;
    public $ticketdescription;
    public $id;
    public $subject;
    public $description;
    public $categories;
    public $user_id;
    public $category_id;
    public $priority;
    public $status;
    public Ticket $ticket;
    public $confirmingTicketAdd = false;
    public $confirmingTicketEdit = false;
    public $confirmingTicketShow = false;
    protected $rules = [
        'subject' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'category_id' => 'required',
        'priority' => 'required|string',
    ];
    public function mount()
    {
        $this->priority = Priority::cases();
        $this->categories = Category::all();
    }
    public function toggleStatus($id)
    {
        $ticket = Ticket::find($id);

        if($ticket){
            if($ticket->status){
                $ticket->status = 0;
            }
            else{
                $ticket->status = 1;
            }
            $ticket->save();
        }
        return redirect()->route('home');
    }
    public function confirmTicketAdd()
    {
        $this->reset(['subject','description','priority','category_id']);
        $this->confirmingTicketAdd = true;
    }
    public function submit()
    {
        $this->validate();

        $ticket = new Ticket;
        $ticket->user_id = auth()->id();
        $ticket->subject = $this->subject;
        $ticket->description = $this->description;
        $ticket->priority = $this->priority;
        $ticket->status;
        $ticket->category_id = $this->category_id;
        
        $ticket->save();

        return redirect()->route('home');
    }
    public function confirmTicketEdit(Ticket $ticket)
    {
        $this->id = $ticket->id;
        $this->subject = $ticket->subject;
        $this->description = $ticket->description;
        $this->category_id = $ticket->category_id;
        $this->priority = $ticket->priority; 

        $this->confirmingTicketEdit = true;
    }
    public function ticketEdit(Ticket $ticket)
    {
        $this->validate();

        $ticket = Ticket::find($this->id);
        if (!$ticket) {
            session()->flash('error', 'Ticket não encontrado.');
            return redirect()->route('home');
        }

        $ticket->subject = $this->subject;
        $ticket->description = $this->description;
        $ticket->category_id = $this->category_id;
        $ticket->priority = $this->priority;
        $ticket->save();

        $this->confirmingTicketEdit = false;
    }

    public function confirmTicketShow(Ticket $support)
    {
        $this->ticketdescription = $support;

        $this->confirmingTicketShow = true;
    }
    public function confirmTicketDeletion(Ticket $ticket)
    {
         try{
            if ($this->authorize('delete-ticket',$ticket))
            {
                try{
                    if($ticket->delete()){
                        session()->flash('success', 'Ticket deletado com sucesso!');
                    }
                }catch(\Exception $e){
                    session()->flash('error', 'Não é possível deletar um ticket em uso!');
                }
            }
                return redirect()->route('home');
        }catch(\Exception $e){
            session()->flash('error', 'Permissão necessária para realizar essa ação!');
        }
        $this->confirmingTicketShow = false;
    }
    public function render(Ticket $tickets)
    {
        $supports = auth()->user()->tickets()->orderBy('priority')->paginate(5);
        $adm_tickets = $tickets->orderBy('priority')->paginate(10);
        $showtickets = $this->ticketdescription;

        return view('livewire.home-page',[
            'supports' => $supports,
            'showticket' => $showtickets,
            'adm_tickets' => $adm_tickets,
        ]);
    }
}