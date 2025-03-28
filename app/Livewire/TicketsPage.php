<?php

namespace App\Livewire;

use App\Models\Category\Category;
use Livewire\Component;
use App\Models\Ticket\Ticket;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class TicketsPage extends Component
{
    public $tickets;
    public $subject;
    public $description;
    public $categories;
    public $users;
    protected $rules = [
        'subject' => 'required',
        'description' => 'required',
        'category' => 'required'
    ];
    public function submit(Request $request)
    {
        $ticket = new Ticket;
        // $user = auth()->user()
        // $ticket -> user_id = $user->id;
        $ticket-> subject = $this -> subject;
        $ticket-> description = $this -> description;
        $ticket-> category_id = $this -> categories;
        $ticket-> save();
    }
    public function mount()
    {
        // $this ->user = Auth::class;
        $this -> categories = Category::all();
    }
    public function render()
    {
        return view('livewire.tickets-page');
    }
}
