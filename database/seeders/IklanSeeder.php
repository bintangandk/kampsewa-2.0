<?php

namespace Database\Seeders;

use App\Models\Iklan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IklanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Iklan::factory(500)->create();
    }
}
