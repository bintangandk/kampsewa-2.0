<?php

namespace Database\Seeders;

use App\Models\StatusNotifikasiUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusNotifikasiUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusNotifikasiUser::factory(500)->create();
    }
}
