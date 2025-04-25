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
        try{
            if(!$this->category->delete()){
                throw new \Exception('Não é possivel deletar uma categoria em uso',1);
            }
        }catch(\Exception $e){
            session()->flash('error','Não é possível deletar uma categoria em uso');
        }

        $this->dispatch('CategoryDeleted');
        $this ->dispatch('refresh');
        return redirect('/categories');
    }
    public function render()
    {
        return view('livewire.category-delete');
    }
}
