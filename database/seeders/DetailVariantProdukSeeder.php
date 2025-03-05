<?php

namespace Database\Seeders;

use App\Models\DetailVariantProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailVariantProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailVariantProduk::factory(500)->create();
    }
}
