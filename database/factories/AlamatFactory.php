<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alamat>
 */
class AlamatFactory extends Factory
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
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
            'detail_lainnya' => $this->faker->sentence(),
            'type' => $this->faker->numberBetween(0, 2),
        ];
    }
}
