<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailVariantProduk>
 */
class DetailVariantProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_variant_produk' => $this->faker->numberBetween(1, 500),
            'ukuran' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'stok' => $this->faker->numberBetween(1, 300),
            'harga_sewa' => $this->faker->numberBetween(10000, 100000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
