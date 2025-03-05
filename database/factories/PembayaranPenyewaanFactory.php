<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PembayaranPenyewaan>
 */
class PembayaranPenyewaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_penyewaan'=>$this->faker->numberBetween(1,500),
            'bukti_pembayaran'=>$this->faker->imageUrl(),
            'jaminan_sewa'=>$this->faker->imageUrl(),
            'jumlah_pembayaran'=>$this->faker->numberBetween(10000,100000),
            'kembalian_pembayaran'=>$this->faker->numberBetween(0, 100000),
            'kurang_pembayaran'=>$this->faker->numberBetween(0, 100000),
            'total_pembayaran'=>$this->faker->numberBetween(10000,100000),
            'metode'=>$this->faker->randomElement(['transfer', 'bayar_ditempat']),
            'status_pembayaran'=>$this->faker->randomElement(['lunas', 'belum lunas']),
            'jenis_transaksi'=>$this->faker->randomElement(['ambil ditempat', 'antar ditempat']),
            'biaya_admin'=>$this->faker->numberBetween(10000, 100000),
            'created_at'=>$this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
