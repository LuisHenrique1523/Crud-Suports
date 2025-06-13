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
        $this->call(RolePermissionSeeder::class);

        Category::factory(2)->create();

        Ticket::factory(10)->create();

        User::factory(10)
        ->withRole('user')
        ->withPermissions(['create-ticket','edit-ticket','delete-ticket',])
        ->create();
    }
}
