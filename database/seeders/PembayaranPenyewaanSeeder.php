<?php

namespace Database\Seeders;

use App\Models\PembayaranPenyewaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranPenyewaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PembayaranPenyewaan::factory(500)->create();
    }
}
