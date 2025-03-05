<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penyewaan>
 */
class PenyewaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => $this->faker->numberBetween(1, 500),
            'tanggal_mulai'=>$this->faker->date(),
            'tanggal_selesai'=>$this->faker->date(),
            'status_penyewaan'=>$this->faker->randomElement(['pending', 'berlangsung', 'selesai']),
            'pesan'=>$this->faker->sentence(),
            'created_at'=>$this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
