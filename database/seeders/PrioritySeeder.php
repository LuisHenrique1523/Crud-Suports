<?php

namespace Database\Seeders;

use App\Models\Priority\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priority::create([
            'Baixa' => '1',
            'Média' => '2',
            'Alta' => '3',
        ]);
    }
}
