<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category\Category;

class Categories extends Component 
{
    public $id;
    public Category $category;
    public $categories;
    public $name;
    public $color;
    public $confirmingCategoryAdd = false;
    public $confirmingCategoryEdit = false;
    protected $rules = [
        'name' => 'required|string|max:255',
        'color' => 'required|string',
    ];
    public function mount(Category $category)
    {
        $this->categories = Category::all();
        $this->category = $category;
    }
    public function confirmCategoryAdd()
    {
        $this->reset(['name','color']);
        $this->confirmingCategoryAdd = true;
    }
    public function submit()
    {
        $this->validate();
            $category = new Category;
            $category->name = $this->name;
            $category->color = $this->color;
            
            $category->save();

        return redirect()->route('categories');
    }
    public function confirmCategoryEdit(Category $category)
    {
        try {
            $categoryInUse = \DB::table('tickets')
                ->where('category_id', $category->id)
                ->exists();

            if ($categoryInUse) {
                session()->flash('error', 'Não é possível editar uma categoria em uso!');
            } else {
                    $this->id = $category->id;
                    $this->name = $category->name;
                    $this->color = $category->color;

                    $this->confirmingCategoryEdit = true;
            }
        }catch (\Exception $e) {
            session()->flash('error', 'Erro!');
        }
    }
    public function categoryEdit(Category $category)
    {
        $this->validate();

        $category = Category::find($this->id);
        if (!$category) {
            session()->flash('error', 'Categoria não encontrada.');
            return redirect()->route('categories');
        }
        $category->name = $this->name;
        $category->color = $this->color;
        $category->save();
        
        return redirect()->route('categories');
        
    }
    public function confirmCategoryDeletion( Category $category)
    {
        try{
            if($category->delete()){
                session()->flash('success', 'Categoria deletada com sucesso!');
            }
        }catch(\Exception $e){
            session()->flash('error', 'Não é possível deletar uma categoria em uso!');
        }

        $this->dispatch('CategoryDeleted');
        $this ->dispatch('refresh');
        return redirect('/categories');
    }
    
    public function render()
    {
        return view('livewire.categories');
    }
}
