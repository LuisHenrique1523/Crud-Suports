<?php

namespace Database\Seeders;

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

        Ticket::factory(3)->create();

        // $this->call(RolePermissionSeeder::class);
    }
}
