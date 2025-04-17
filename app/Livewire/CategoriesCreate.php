<?php

namespace App\Livewire;

use App\Models\Category\Category;
use Livewire\Component;

class CategoriesCreate extends Component
{
    public $categories;
    public $name;
    public $color;
    public function submit()
    {
        $category = new Category;
        $category->name = $this->name;
        $category->color = $this->color;
        $category->save();
        
        return redirect()->to('/categories');
    }
    public function mount(Category $category)
    {
        $this->categories = Category::all();
    }
    public function render()
    {
        return view('livewire.categories-create');
    }
}
