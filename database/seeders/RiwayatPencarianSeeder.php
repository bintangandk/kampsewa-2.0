<?php

namespace Database\Seeders;

use App\Models\RiwayatPencarian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiwayatPencarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RiwayatPencarian::factory(500)->create();
    }
}
