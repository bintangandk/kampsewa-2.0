<?php

namespace Database\Seeders;

use App\Models\RatingProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RatingProduk::factory(500)->create();
    }
}
