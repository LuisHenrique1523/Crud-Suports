<?php

namespace App\Livewire;

use App\Models\Operation\Operation;
use Livewire\Component;

class OperationsEdit extends Component
{
    public $description;
    public Operation $operation;
    public function mount(Operation $operation)
    {
        $this->description = $operation->description;
    }
    public function operationEdit()
    {
        $validated = $this->validate([
            'description' => 'required',
        ]);
        
        $this->operation->update($validated);
        
        return redirect()->to("home");
    }
    public function render()
    {
        return view('livewire.operations-edit');
    }
}
