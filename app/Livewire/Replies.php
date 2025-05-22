<?php

namespace App\Livewire;

use App\Models\Reply;
use App\Models\Ticket\Ticket;
use Livewire\Component;

class Replies extends Component
{
    public $id;
    public $reply;
    public $reply_id;
    public $ticket_user = [];
    public $replies;
    public $confirmingReplyAdd = false;
    public $confirmingReplyEdit = false;
    protected $rules = [
        'reply' => 'required|string|max:255',
    ];
    public function mount()
    {
        $this->reply_id = request()->route('ticket');
        $this->ticket_user = Ticket::where('id', request()->route('ticket'))->value('user_id');
    }
    public function confirmReplyAdd()
    {
        $this->reset(['reply']);
        $this->confirmingReplyAdd = true;
    }
    public function submit()
    {
        $this->validate();
        $reply = new Reply;
        $reply->user_id = auth()->id();
        $reply->ticket_user_id = $this->ticket_user;
        $reply->ticket_id = $this->reply_id;
        $reply->reply = $this->reply;
        
        $reply->save();

        return redirect()->route('replies',[$this->reply_id]);
    }
    public function confirmReplyEdit( Reply $reply)
    {
        $this->id = $reply->id;
        $this->reply = $reply->reply;

        $this->confirmingReplyEdit = true;
    }
    public function replyEdit(Reply $reply)
    {
        $this->validate();

        $reply = Reply::find($this->id);
        if (!$reply) {
            session()->flash('error', 'Categoria não encontrada.');
            return redirect()->route('replies',[$this->reply_id]);
        }

        $reply->reply = $this->reply;
        $reply->save();

        return redirect()->route('replies',[$this->reply_id]);
    }

    public function confirmReplyDeletion( Reply $reply)
    {
        try{
            if($reply->delete()){
                session()->flash('success', 'Resposta deletada com sucesso!');
            }
        }catch(\Exception $e){
            session()->flash('error', 'Não foi possível deletar esta resposta!');
        }

        $this ->dispatch('refresh');
        $this->dispatch('ReplyDeleted');
        return redirect()->route('replies',[$this->reply_id]);
    }
    public function render( Reply $reply)
    {   
        $this->replies = Reply::where('ticket_id', request()->route('ticket'))->get();
        $ticket = Ticket::where('id',request()->route('ticket'))->value('status');

        return view('livewire.replies',[
            'ticket' => $ticket,
        ]);
    }
}
