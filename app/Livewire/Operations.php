<?php

namespace App\Livewire;

use App\Models\Operation\Operation;
use Livewire\Component;

class Operations extends Component
{
    public $operations;
    public $users;
    public $tickets;
    public $listeners = ['CategoryDeleted' => '$refresh',];

    public function mount(Operation $operations)
    {
        $this->operations = Operation::all();
    }
    public function render(Operation $operation)
    {
        return view('livewire.operations');
    }
}
