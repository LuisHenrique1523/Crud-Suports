<?php

namespace App\Livewire;

use App\Models\Category\Category;
use Livewire\Component;

class CategoriesEdit extends Component
{
    public $id;
    public $name;
    public  $color;
    public Category $category;
    public function mount(Category $category)
    {
        $this->id = $category->id;
        $this->name = $category->name;
        $this->color = $category->color;
    }
    public function categoryEdit()
    {
        $validated = $this->validate([
            'id' => 'required',
            'name' => 'required',
            'color' => 'required',
        ]);
        
        $this->category->update($validated);
        
        return redirect()->to('/categories');
    }
    public function render()
    {
        return view('livewire.categories-edit');
    }
}