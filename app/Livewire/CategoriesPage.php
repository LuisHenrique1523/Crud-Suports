<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category\Category;

class CategoriesPage extends Component
{
    public $category;
    public $categories;
    public $name;
    public $color;
    public $confirmingCategoryAdd = false;
    public $confirmingCategoryEdit = false;
    public $listeners = [
        'CategoryDeleted' => '$refresh',
        'refresh' => '$refresh',
    ];
    protected $rules = [
        'name' => 'required',
        'color' => 'required'
    ];
    public function mount(Category $category)
    {
        $this->categories = Category::all();

    }
    public function submit()
    {
        $this->validate();

        if(isset($this->category->id)){
            $this->category->update();
        } else{
            $category = new Category;
            $category->name = $this->name;
            $category->color = $this->color;
            $category->save();
            
            return redirect()->to('/categories');
        }
        $this->confirmingCategoryAdd = false;
    }
    public function render()
    {
        return view('livewire.categories-page');
    }
    public function confirmCategoryAdd()
    {
        $this->reset(['category']);
        $this->confirmingCategoryAdd = true;
    }
    public function confirmCategoryEdit(Category $category)
    {
        $this->category = $category;
        $this->confirmingCategoryAdd = true;
    }
    public function confirmCategoryDeletion( Category $category)
    {
        try{
            if($category->delete()){
                session()->flash('success');
            }
        }catch(\Exception $e){
            session()->flash('error');
        }

        $this->dispatch('CategoryDeleted');
        $this ->dispatch('refresh');
        return redirect('/categories');
    }
}
