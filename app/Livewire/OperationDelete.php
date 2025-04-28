<?php

namespace App\Livewire;

use App\Models\Operation\Operation;
use Livewire\Component;

class OperationDelete extends Component
{
    public $operation;
    public function mount($id)
    {
        $this->operation = Operation::find($id);
    }
    public function DeleteOperation()
    {
        $this->operation->delete();
        
            return redirect('home');
            
        $this->dispatch('ComentaryDeleted');
        $this ->dispatch('refresh');
    }
    public function render()
    {
        return view('livewire.operation-delete');
    }
}
