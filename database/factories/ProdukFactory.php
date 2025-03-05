<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
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
            'nama' => $this->faker->word,
            'deskripsi' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['Tersedia', 'Tidak Tersedia']),
            'kategori' => $this->faker->randomElement(['Tenda', 'Pakaian', 'Tas', 'Sepatu', 'Perlengkapan']),
            'foto_depan' => $this->faker->imageUrl(),
            'foto_belakang' => $this->faker->imageUrl(),
            'foto_kiri' => $this->faker->imageUrl(),
            'foto_kanan' => $this->faker->imageUrl(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
