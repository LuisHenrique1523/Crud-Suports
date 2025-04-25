<?php

namespace App\Livewire;

use App\Models\Comemntary\Commentary;
use Livewire\Component;

class Commentaries extends Component
{
    public $id;
    public $commentaries;
    public function mount()
    {
        $this->commentaries = Commentary::all();
    }
    public function render(Commentary $commentaries)
    {
        $comments = auth()->user()->commentaries;
        return view('livewire.commentaries',compact('comments'));
    }
}
