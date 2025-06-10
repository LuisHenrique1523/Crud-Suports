<?php

namespace Database\Factories\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colors = ['#7E442E','#FF0000','#2A9D8F','#3A5F8C','#FFB703'];
        return [
            'name' => 'categoria',
            'color' => $this->faker->randomElement($colors),
        ];
    }
}
