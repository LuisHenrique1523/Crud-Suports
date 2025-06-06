<?php

namespace Database\Seeders;

use App\Models\Category\Category;
use App\Models\Ticket\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Ticket::factory(20)->create();

        // Category::factory(2)->create();

        $this->call(RolePermissionSeeder::class);
    }
}
