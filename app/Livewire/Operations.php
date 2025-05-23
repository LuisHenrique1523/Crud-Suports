<?php

namespace App\Livewire;

use App\Models\Operation\Operation;
use App\Models\Ticket\Ticket;
use Livewire\Component;

class Operations extends Component
{
    public $ticket = [];
    public $id;
    public $description;
    public $operations;
    public Operation $operation;
    public $confirmingOperationAdd = false; 
    public $confirmingOperationEdit = false;
    protected $rules = [
        'description' => 'required|string|max:255',
    ];
    public function mount(Operation $operation, Ticket $ticket)
    {
        $this->operations = Operation::where('ticket_id', request()->route('ticket'))->get();
        $this->ticket = request()->route('ticket');
        $this->operation = $operation;
    }
    public function confirmOperationAdd()
    {
        $this->reset(['description']);
        $this->confirmingOperationAdd = true;
    }
    public function submit()
    {
        $this->validate();
            $operation = new Operation;
            $operation->user_id = auth()->user()->id;
            $operation->ticket_id = $this->ticket;
            $operation->description = $this->description;

            $operation->save();

            return redirect()->route('operations',[$operation->ticket_id]);
    }
    public function confirmOperationEdit(Operation $operation)
    {  
        $this->id = $operation->id;
        $this->description = $operation->description;
        $this->confirmingOperationEdit = true;
    }
    public function OperationEdit(Operation $operation)
    {
        $this->validate();

        $operation = Operation::find($this->id);
        if (!$operation) {
            session()->flash('error', 'Operação não encontrada.');
            return redirect()->route('operations',[$operation->ticket_id]);
        }

        $operation->description = $this->description;
        $operation->user_id = auth()->user()->id;
        $operation->ticket_id = $this->ticket;
        $operation->save();

        return redirect()->route('operations',[$operation->ticket_id]);
    }
    public function confirmOperationDeletion( Operation $operation)
    {
        try{
            if($operation->delete()){
                session()->flash('success', 'Operação deletada com sucesso!');
            }
        }catch(\Exception $e){
            session()->flash('error', 'Não foi possível deletar a operação em uso!');
        }

        $this ->dispatch('refresh');
        $this->dispatch('CommentDeleted');
        return redirect()->route('operations',[$operation->ticket_id]);
    }
    public function render()
    {
        return view('livewire.operations');
    }
}
