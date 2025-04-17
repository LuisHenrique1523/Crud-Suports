<?php

namespace App\Livewire;

use App\Models\Comemntary\Commentary;
use Livewire\Component;

class DeleteComment extends Component
{
    public $comment;
    public function mount($id)
    {
        $this->comment = Commentary::find($id);
    }

    public function DeleteComentary()
    {
        $this->comment->delete();
        session()-> flash('success', 'Comentário removido com sucesso!');

        if(!$this->comment->delete()){
            session()->flash('error','Não é possível deletar este comentário');
            return redirect('/comments');
        }
        $this->dispatch('ComentaryDeleted');
        $this ->dispatch('refresh');
    }
    public function render()
    {
        return view('livewire.delete-comment');
    }
}
