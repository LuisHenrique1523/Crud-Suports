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
            if($this->category->delete()){
                session()->flash('success');
            }
        }catch(\Exception $e){
            session()->flash('error');
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
