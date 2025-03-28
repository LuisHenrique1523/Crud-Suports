<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersPage extends Component
{
    public $user;
    public function mount(User $user){
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.users-page');
    }
}
