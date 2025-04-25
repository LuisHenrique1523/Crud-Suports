<?php

namespace App\Livewire;

use App\Models\Comemntary\Commentary;
use Livewire\Component;

class CommentariesEdit extends Component
{ 
    public $id;
    public $content;
    public $comment;
    public function mount(Commentary $comment)
    {
        $this->id = $comment->id;
        $this->content = $comment->content;
    }
    public function CommentEdit()
    {
        $validated = $this->validate([
            'id' => 'required',
            'content' => 'required',
        ]);
        
        $this->comment->update($validated);
        
        return redirect()->to('/comments');
    }
    public function render()
    {
        return view('livewire.commentaries-edit');
    }
}
