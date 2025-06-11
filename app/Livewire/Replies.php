<?php

namespace App\Livewire;

use App\Models\Reply;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;

class Replies extends Component
{
    public $ticket_id = [];
    public $id;
    public $reply;
    public $user_id;
    public $ticket_creator;
    public $get_creator;
    public $reply_id;
    public $replies;
    public $confirmingReplyAdd = false;
    public $confirmingReplyEdit = false;
    protected $rules = [
        'reply' => 'required|string|max:255',
    ];
    public function mount($ticketID = null, $ticketUserID = null)
    {
        $this->ticket_id = $ticketId ?? request()->route('ticket');
        $this->replies = Reply::where('ticket_id', request()->route('ticket'))->get();
        $this->user_id = $ticketUserID ?? Ticket::where('id', request()->route('ticket'))->value('user_id');
        $reply = Reply::with('creator')->get();
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
        $reply->ticket_creator = $this->user_id;
        $reply->ticket_id = $this->ticket_id;
        $reply->reply = $this->reply;
        
        $reply->save();

        return redirect()->route('replies',[$this->ticket_id]);
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
            return redirect()->route('replies',[$this->ticket_id]);
        }

        $reply->reply = $this->reply;
        $reply->save();

        return redirect()->route('replies',[$this->ticket_id]);
    }
    public function get_creator_name($ticket_creator)
    {
        $this->get_creator = User::find($ticket_creator);
    }
    public function confirmReplyDeletion( Reply $reply)
    {
        try{
            $this->authorize('delete',$reply);
                try{
                    if($reply->delete()){
                        session()->flash('success', 'Resposta deletada com sucesso!');
                    }
                }catch(\Exception $e){
                    session()->flash('error', 'Não foi possível deletar esta resposta!');
                }

            return redirect()->route('replies',[$this->ticket_id]);
        }catch(AuthorizationException $e){
            session()->flash('error', 'Permissão necessária para realizar essa ação!');
        }
    }
    
    public function render( Reply $reply)
    {   
        $ticket = Ticket::where('id',request()->route('ticket'))->value('status');

        return view('livewire.replies',[
            'ticket' => $ticket,
        ]);
    }
}
