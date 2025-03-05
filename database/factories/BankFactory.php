<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bank>
 */
class BankFactory extends Factory
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
            'rekening' => $this->faker->numerify('################'),
            'bank' => $this->faker->randomElement(['BCA', 'MANDIRI', 'BRI', 'BNI', 'BTN', 'BSI']),
        ];
    }
}
