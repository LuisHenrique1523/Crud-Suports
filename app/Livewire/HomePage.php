<?php

namespace App\Livewire;

use App\Enums\Priority;
use App\Models\Category\Category;
use App\Models\Ticket\Ticket;
use Livewire\{Component,WithPagination};

class HomePage extends Component
{
    use WithPagination;
    public $pc;
    public $id;
    public $subject;
    public $description;
    public $categories;
    public $category_id;
    public Ticket $tickets;
    public $priority;
    public $confirmingTicketAdd = false;
    public $confirmingTicketEdit = false;
    public $confirmingTicketShow = false;
    protected $rules = [
        'subject' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'priority' => 'required|string',
        'category_id' => 'required',
    ];
    public function mount()
    {
        $this->priority = Priority::cases();
        $this->categories = Category::all();
    }
    public function status($id)
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
        return redirect()->route('dashboard');
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

        return redirect()->route('dashboard');
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
            session()->flash('error', 'Categoria não encontrada.');
            return;
        }

        $ticket->subject = $this->subject;
        $ticket->description = $this->description;
        $ticket->category_id = $this->category_id;
        $ticket->priority = $this->priority;
        $ticket->save();

        return redirect()->route('dashboard');
    }

    public function confirmTicketShow(Ticket $support)
    {
        $this->pc = $support;
        $showtickets = Ticket::where('id',$support)->first();
        // dd($this->pc);
        $this->confirmingTicketShow = true;
    }
    public function confirmTicketDeletion( Ticket $ticket)
    {
        try{
            if($ticket->delete()){
                session()->flash('success');
            }
        }catch(\Exception $e){
            session()->flash('error');
        }

        $this ->dispatch('refresh');
        return redirect('/dashboard');
    }
    public function confirmCommentsAdd()
    {
        return redirect(route('comments'));
    }
    public function render(Ticket $tickets)
    {
        $supports = auth()->user()->tickets()->orderBy('priority')->get();
        $tick = $tickets->orderBy('priority')->paginate(10);
        $showtickets = $this->pc;

        return view('livewire.home-page',[
            'tick' => $tick,
            'supports' => $supports,
            'showticket' => $showtickets,
        ]);
    }
}
