<?php

namespace App\Livewire;

use App\Enums\Priority;
use App\Models\Category\Category;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
use Livewire\{Component,WithPagination};

use function Laravel\Prompts\select;

class HomePage extends Component
{
    use WithPagination;
    public $pc;
    public $subject;
    public $description;
    public $categories;
    public $category_id;
    public Ticket $tickets;
    public $priority;
    public $confirmingTicketAdd = false;
    public $confirmingTicketShow = false;
    public $listeners = [
        'TicketDeleted' => '$refresh',
        'refresh' => '$refresh',
];
    protected $rules = [
        'subject' => 'required',
        'description' => 'required',
        'priority' => 'required',
        'category_id' => 'required'
    ];
    public function mount()
    {
        $this->priority = Priority::cases();
        $this->categories = Category::all();
    }
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
    public function update($id)
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
        return redirect('home');
    }
    public function confirmTicketAdd()
    {
        $this->confirmingTicketAdd = true;
    }
    public function confirmTicketShow($ti)
    {
        $pc = Ticket::find($ti);
        $this->confirmingTicketShow = true;
        return view('livewire.home-page', ['pc' => $pc]);
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

        $this->dispatch('TicketDeleted');
        $this ->dispatch('refresh');
        return redirect('/dashboard');
    }
    public function render(Ticket $tickets)
    {
        $supports = auth()->user()->tickets()->orderBy('priority')->get();
        $tick = $tickets->orderBy('priority')->paginate(10);
        return view('livewire.home-page',compact('tick','supports'));
    }
}
