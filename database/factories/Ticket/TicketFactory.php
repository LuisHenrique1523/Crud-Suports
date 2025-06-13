<?php

namespace Database\Factories\Ticket;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => 'Assunto',
            'description' => 'Descrição',
            'priority' => '1',
            'status' => '1',
            'user_id' => '1',
            'category_id' => '1',
        ];
    }
}
