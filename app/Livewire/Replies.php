<?php

namespace App\Livewire;

use App\Models\Reply;
use Livewire\Component;

class Replies extends Component
{
    public $replyRecord = [];
    public $reply;
    public $replies;
    public function mount($replyRecord)
    {
        $this->replyRecord = $replyRecord;
    }
    public function submit()
    {
        $reply = new Reply;
        $reply->user_id = auth()->id();
        $reply->ticket_id = $this->replyRecord;
        $reply->reply = $this->replies;
        // dd($reply);
        $reply->save();
    }
    public function render()
    {
        $this->reply = Reply::all('reply');
        return view('livewire.replies');
    }
}
