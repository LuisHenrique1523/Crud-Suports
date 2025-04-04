<?php

namespace App\Livewire;

use App\Models\Category\Category;
use Livewire\Component;

class CategoriesEdit extends Component
{
    public $id;
    public $category;
    public  $color;
    public function categoryEdit($id)
    {
        $category = Category::find($id);
        $this->id = $category->id;
        $this->category = $category->category;
        $this->color = $category->color;
    }
    public function render()
    {
        return view('livewire.categories-edit');
    }
}
