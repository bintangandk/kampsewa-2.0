<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
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
             'deskripsi' => $this->faker->paragraph,
             'kriteria' => $this->faker->randomElement(['Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Sangat Kurang']),
             'status' => $this->faker->randomElement(['Dibalas', 'Belum Dibalas']),
             'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
             'updated_at' => now(),
         ];
    }
}
