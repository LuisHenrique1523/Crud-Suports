<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category\Category;

class CategoriesPage extends Component
{
    public $categories;
    public $listeners = [
        'CategoryDeleted' => '$refresh',
        'refresh-me' => '$refresh',
    ];
    protected $rules = [
        'name' => 'required',
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
