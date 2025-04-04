<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category\Category;

class CategoriesPage extends Component
{
    public $category;
    public  $color;
    public $categories;
    public $listeners = ['CategoryDeleted' => '$refresh'];
    protected $rules = [
        'category' => 'required',
        'color' => 'required'
    ];
    public function mount(Category $category)
    {
        $this -> categories = Category::all();
    }
    public function render()
    {
        return view('livewire.categories-page');
    }
}
