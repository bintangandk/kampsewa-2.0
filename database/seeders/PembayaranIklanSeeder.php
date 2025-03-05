<?php

namespace Database\Seeders;

use App\Models\PembayaranIklan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranIklanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PembayaranIklan::factory(500)->create();
    }
}
