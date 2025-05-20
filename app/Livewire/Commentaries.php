<?php

namespace App\Livewire;

use App\Models\Comemntary\Commentary;
use Livewire\Component;

class Commentaries extends Component
{
    public $ticket = [];
    public $id;
    public $content;
    public Commentary $comment;
    public $commentaries;
    public $confirmingCommentAdd = false;
    public $confirmingCommentEdit = false;
    protected $rules = [
        'content' => 'required|string|max:255',
    ];
    public function mount(Commentary $comment)
    {
        $this->commentaries = Commentary::where('ticket_id',request()->route('ticket'))->get();
        $this->ticket = request()->route('ticket');
        $this->comment = $comment;
    }
    public function confirmCommentAdd()
    {
        $this->reset(['content']);
        $this->confirmingCommentAdd = true;
    }
    public function submit()
    {
        $this->validate();
            $comment = new Commentary;
            $comment->content = $this->content;
            $comment->user_id = auth()->user()->id;
            $comment->ticket_id = $this->ticket;

            $comment->save();

        return redirect()->route('commentaries',[$comment->ticket_id]);
    }
    public function confirmCommentEdit(Commentary $comment)
    {  
        $this->id = $comment->id;
        $this->content = $comment->content;
        $this->confirmingCommentEdit = true;
    }
    public function CommentEdit(Commentary $comment)
    {
        $this->validate();

        $comment = Commentary::find($this->id);
        if (!$comment) {
            session()->flash('error', 'Comentário não encontrado.');
            return;
        }

        $comment->content = $this->content;
        $comment->user_id = auth()->user()->id;
        $comment->ticket_id = $this->ticket;
        $comment->save();

        return redirect()->route('commentaries',[$comment->ticket_id]);
    }
    public function confirmCommentDeletion( Commentary $commentary)
    {
        try{
            if($commentary->delete()){
                session()->flash('success', 'Comentário deletado com sucesso!');
            }
        }catch(\Exception $e){
            session()->flash('error', 'Não foi possível deletar este comentário!');
        }

        $this ->dispatch('refresh');
        $this->dispatch('CommentDeleted');
        return redirect()->route('commentaries',[$commentary->ticket_id]);
    }
    public function render(Commentary $comment)
    {
        $comments = Commentary::where('ticket_id', request()->route('ticket'));
        return view('livewire.commentaries',compact('comments'));
    }
}
