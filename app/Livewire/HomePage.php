<?php

namespace App\Livewire;

use App\Models\Category\Category;
use App\Models\Ticket\Ticket;
use Livewire\{Component,WithPagination};

class HomePage extends Component
{
    use WithPagination;
    public $categories;
    public $listeners = ['TicketDeleted' => '$refresh'];
    public function mount()
    {
        $this->categories = Category::all();
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
        return redirect('/home');
    }
    public function render(Ticket $tickets)
    {
        $supports = auth()->user()->tickets;
        $tick = $tickets->orderByDesc('priority')->paginate(10);
        // dd($supports);
        return view('livewire.home-page',compact('tick','supports'));
    }
}
