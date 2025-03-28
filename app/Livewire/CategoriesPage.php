<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category\Category;

class CategoriesPage extends Component
{
    public $categories;
    protected $rules = [
        'category' => 'required',
        'color' => 'required'
    ];
    public function submit()
    {
        $validateData = $this->validate();
        Category::create($validateData);
    }
    public function mount()
    {
        $this -> categories = Category::all();
    }
    public function render()
    {
        return view('livewire.categories-page');
    }
}
