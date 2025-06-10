<?php

namespace Tests\Feature;

use App\Livewire\Categories;
use App\Models\Category\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;
    public function test_modal_create_category()
    {
        $category = Livewire::test(Categories::class)
        ->call('confirmCategoryAdd')
        ->assertStatus(200);
    }
    public function test_create_category()
    {
        Livewire::test(Categories::class)
            ->set('name', 'Categoria Teste')
            ->set('color', '#7E442E')
            ->call('submit');
    
        $this->assertTrue(Category::whereName('Categoria Teste')->exists());
    }
    public function test_modal_edit_category()
    {
        $category = Livewire::test(Categories::class)
        ->call('confirmCategoryEdit')
        ->assertStatus(200);
    }
    public function test_edit_category()
    {
        $category = Livewire::test(Categories::class)
                    ->set('name', 'Categoria Teste')
                    ->set('color', '#7E442E')
                    ->call('submit');

        $category = $edited = [
            'name' => 'Categoria editada',
            'color' => 'FF0000',
        ];

        $this->assertSame($edited, $category);
    }
    public function test_delete_category()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user);

        Livewire::test(Categories::class)
                ->set('name', 'Categoria Teste')
                ->set('color', '#7E442E')
                ->call('submit');

        $this->assertDatabaseHas('categories', [
                'name' => 'Categoria Teste',
                'color' => '#7E442E',
            ]);
        
        $category = Category::where('name', 'Categoria Teste')->first();

         Livewire::test(Categories::class)
                ->call('confirmCategoryDeletion', $category->id);

        $this->assertDatabaseMissing('categories', [
        'id' => $category->id,
        ]);
    }
}