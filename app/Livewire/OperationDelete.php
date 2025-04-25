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
        // dd($this->operation);
    }
    public function DeleteOperation()
    {
        $this->operation->delete();
        session()-> flash('success', 'Comentário removido com sucesso!');

        if(!$this->operation->delete()){
            session()->flash('error','Não é possível deletar este comentário');
            return redirect('/operations');
        }
        $this->dispatch('ComentaryDeleted');
        $this ->dispatch('refresh');
    }
    public function render()
    {
        return view('livewire.operation-delete');
    }
}
