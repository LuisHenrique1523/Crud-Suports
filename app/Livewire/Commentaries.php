<?php

namespace App\Livewire;

use App\Models\Commentary\Commentary;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Commentaries extends Component
{
    public $ticket_id = [];
    public $id;
    public $content;
    public $user_id;
    public Commentary $comment;
    public $commentaries;
    public $confirmingCommentAdd = false;
    public $confirmingCommentEdit = false;
    protected $rules = [
        'content' => 'required|string|max:255',
    ];
    public function mount(Commentary $comment, $ticketID = null)
    {
        $this->ticket_id = $ticketId ?? request()->route('ticket');
        $this->commentaries = Commentary::where('ticket_id',request()->route('ticket'))->get();
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
            $comment->ticket_id = $this->ticket_id;

            $comment->save();

        return redirect()->route('commentaries',[$comment->ticket_id]);
    }
    public function confirmCommentEdit(Commentary $comment)
    {  
        $this->id = $comment->id;
        $this->content = $comment->content;
        $this->user_id = $comment->user_id;
        $this->confirmingCommentEdit = true;
    }
    public function CommentEdit(Commentary $comment)
    {
        $this->validate();

                $comment = Commentary::find($this->id);
                if (!$comment) {
                    session()->flash('error', 'Comentário não encontrado.');
                    return redirect()->route('commentaries',[$comment->ticket_id]);
                }

                $comment->content = $this->content;
                $comment->user_id = $this->user_id;
                $comment->ticket_id = $this->ticket_id;
                $comment->save();

                return redirect()->route('commentaries',[$comment->ticket_id]);
    }
    public function confirmCommentDeletion( Commentary $comment)
    {
        try{
            $this->authorize('delete',$comment);
                try{
                    if($comment->delete()){
                        session()->flash('success', 'Resposta deletada com sucesso!');
                    }
                }catch(\Exception $e){
                    session()->flash('error', 'Não foi possível deletar esta resposta!');
                }

            return redirect()->route('commentaries',[$comment->ticket_id]);
        }catch(AuthorizationException $e){
            session()->flash('error', 'Permissão necessária para realizar essa ação!');
        }
    }
    public function render(Commentary $comment)
    {
        $comments = Commentary::where('ticket_id', request()->route('ticket'));
        return view('livewire.commentaries',compact('comments'));
    }
}
