<?php

namespace App\Livewire;

use App\Models\Category\Category;
use Livewire\Component;

class CategoriesEdit extends Component
{
    public $id;
    public $category;
    public  $color;
    public function mount(Category $id)
    {
        $this->id = $id->id;
        $this->category = $id->category;
        $this->color = $id->color;
    }
    public function categoryEdit($validated)
    {
        $validated = $this->validate([
            'id' => 'required',
            'category' => 'required',
            'color' => 'required',
        
        ]);
        // dd($validated);
        $this->category->update($validated);
        
        return $this->redirect('/categories');
    }
    public function closeModal()
    {
        $this->resetInput();
    }
    public function render()
    {
        return view('livewire.categories-edit');
    }
}