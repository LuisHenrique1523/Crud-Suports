<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category\Category;

class CategoriesPage extends Component
{
    public $category;
    public  $color;
    public $categories;
    protected $rules = [
        'category' => 'required',
        'color' => 'required'
    ];
    public function submit()
    {
        $category = new Category;
        $category ->category = $this ->category;
        $category ->color = $this ->color;
        $category ->save();
        
        return redirect()->to('/');
    }
    public function mount(Category $category)
    {
        $this -> categories = Category::all();
    }
    public function render()
    {
        return view('livewire.categories-page');
    }
}
