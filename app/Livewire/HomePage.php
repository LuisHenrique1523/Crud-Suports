<?php

namespace App\Livewire;

use App\Models\Category\Category;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Livewire\Component;

class HomePage extends Component
{
    public $user;
    public $categories;
    public $tickets;
    // public function mount(User $user){
    //     $this->user = $user;
    // }
    public function mount()
    {
        $this -> categories = Category::all();
        $this -> tickets = Ticket::all();
    }
    public function render()
    {
        return view('livewire.home-page');
    }
}
