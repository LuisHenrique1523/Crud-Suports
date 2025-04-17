<?php

namespace App\Livewire;

use App\Models\Category\Category;
use Livewire\Component;

use function Laravel\Prompts\error;

class DeleteCategory extends Component
{
    public $category;

    public function mount($id)
    {
        $this->category = Category::find($id);
    }

    public function DeleteCategory()
    {
        $this->category->delete();
        session()-> flash('success', 'Categoria removida com sucesso!');

        if(!$this->category->delete()){
            session()->flash('error','Não é possível deletar uma categoria em uso');
            return redirect('/categories');
        }
        $this->dispatch('TicketDeleted');
        $this ->dispatch('refresh');
    }
    public function render()
    {
        return view('livewire.category-delete');
    }
}
