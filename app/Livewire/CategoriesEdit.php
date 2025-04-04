<?php

namespace App\Livewire;

use App\Models\Category\Category;
use Livewire\Component;

class CategoriesEdit extends Component
{
    public $categories;
    public $id;
    public $category;
    public  $color;
    public function mount(Category $id)
    {
        $this->category = $id;
        $this->category = $id->category;
        $this->color = $id->color;
    }
    public function render()
    {
        return view('livewire.categories-edit');
    }
    public function categoryEdit($id)
    {
        $validated = $this->validate([
            'category' => 'required',
            'color' => 'required',
        ]);
    
        $this->category->update($validated);

        return $this->redirect('/categories');
    }
}