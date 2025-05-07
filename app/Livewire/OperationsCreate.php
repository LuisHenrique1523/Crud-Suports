<?php

namespace App\Livewire;

use App\Models\Operation\Operation;
use Dom\Document;
use Livewire\Component;

class OperationsCreate extends Component
{
    public $ticket;
    public $description;
    protected $rules = [
        'description' => 'required',
    ];
    public function submit()
    {
        $operation = new Operation;
        $operation->user_id = auth()->id();
        $operation->ticket_id = $this->ticket;
        $operation->description = $this->description;
        $operation->save();        

        return redirect(route('show',$this->ticket));
    }
    public function render()
    {
        return view('livewire.operations-create');
    }
}
