<?php

namespace Database\Seeders;

use App\Models\Prop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prop::factory()
            ->count(50)
            ->create();
    }
}
