<?php

namespace App\Livewire;

use App\Models\Operation\Operation;
use Livewire\Component;

class Operations extends Component
{
    public $operations;
    public $ticket;
    public $listeners = ['CategoryDeleted' => '$refresh',];

    public function mount(Operation $operations)
    {
        $this->operations = Operation::where('ticket_id', $this->ticket)->get();
    }
    public function render()
    {
        return view('livewire.operations');
    }
}
