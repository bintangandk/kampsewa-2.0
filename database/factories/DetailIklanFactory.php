<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailIklan>
 */
class DetailIklanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_iklan' => $this->faker->numberBetween(1, 500),
            'tanggal_mulai' => $this->faker->date(),
            'tanggal_akhir' => $this->faker->date(),
            'harga_iklan' => $this->faker->numberBetween(10000, 100000),
            'status_iklan' => $this->faker->randomElement(['Aktif', 'Pending', 'Selesai']),
        ];
    }
}
