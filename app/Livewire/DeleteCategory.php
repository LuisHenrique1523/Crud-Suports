<?php

namespace App\Livewire;

use App\Models\Category\Category;
use Livewire\Component;

class DeleteCategory extends Component
{
    public $category;

    public function mount($id)
    {
        $this->category = Category::find($id);
    }

    public function DeleteCategory()
    {
        if(!$this->category) {
            session()-> flash('error', 'Ticket não encontrado!');
            return;
        }

        $this->category->delete();

        session()-> flash('success', 'Ticket removido com sucesso!');
        
        $this->dispatch('TicketDeleted');
    }
    public function render()
    {
        return view('livewire.category-delete');
    }
}
