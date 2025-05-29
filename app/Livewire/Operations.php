<?php

namespace App\Livewire;

use App\Models\Operation\Operation;
use App\Models\Ticket\Ticket;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;

class Operations extends Component
{
    public $ticket = [];
    public $id;
    public $description;
    public $user_id;
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
        $this->user_id = $operation->user_id;
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
                $operation->user_id = $this->user_id;
                $operation->ticket_id = $this->ticket;
                $operation->save();

                return redirect()->route('operations',[$operation->ticket_id]);
    }
    public function confirmOperationDeletion( Operation $operation)
    {
        try{
            $this->authorize('delete',$operation);
                try{
                    if($operation->delete()){
                        session()->flash('success', 'Resposta deletada com sucesso!');
                    }
                }catch(\Exception $e){
                    session()->flash('error', 'Não foi possível deletar esta resposta!');
                }

            return redirect()->route('operations',[$operation->ticket_id]);
        }catch(AuthorizationException $e){
            session()->flash('error', 'Permissão necessária para realizar essa ação!');
        }
    }
    public function render()
    {
        return view('livewire.operations');
    }
}
