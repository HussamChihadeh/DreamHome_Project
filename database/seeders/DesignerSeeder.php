<?php

namespace Database\Seeders;

use App\Models\Designer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Designer::factory()
            ->count(10)
            ->hasFurniture(10)
            ->create();

        Designer::factory()
            ->count(10)
            ->hasFurniture(1)
            ->create();

        Designer::factory()
            ->count(2)
            ->create();
    }
}
