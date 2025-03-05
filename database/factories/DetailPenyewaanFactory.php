<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailPenyewaan>
 */
class DetailPenyewaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_penyewaan'=>$this->faker->numberBetween(1, 500),
            'id_produk'=>$this->faker->numberBetween(1,500),
            'warna_produk'=>$this->faker->colorName(),
            'ukuran' => $this->faker->randomElement(['XS','S','M','L','XL','XXL','XXL']),
            'qty'=>$this->faker->numberBetween(1,200),
            'subtotal'=>$this->faker->numberBetween(10000,100000),
            'created_at'=>$this->faker->dateTimeBetween('-1 year','now'),
        ];
    }
}
