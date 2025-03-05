<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Iklan>
 */
class IklanFactory extends Factory
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
            'poster' => $this->faker->imageUrl(),
            'judul' => $this->faker->sentence(),
            'sub_judul' => $this->faker->sentence(),
            'deskripsi' => $this->faker->paragraph(),
        ];
    }
}
