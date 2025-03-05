<?php

namespace Database\Seeders;

use App\Models\DetailIklan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailIklanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailIklan::factory(500)->create();
    }
}
