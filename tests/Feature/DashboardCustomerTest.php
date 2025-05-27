<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Produk;
use App\Models\Penyewaan;
use App\Models\DetailPenyewaan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardCustomerTest extends TestCase
{
    use RefreshDatabase;

    protected $customer;

    protected function setUp(): void
    {
        parent::setUp();

        // Jalankan migrasi
        $this->artisan('migrate:fresh');

        // Buat customer
        $this->customer = User::factory()->customer()->create();
    }

    /** @test */
    public function customer_can_access_dashboard()
    {
        $response = $this->actingAs($this->customer)
            ->get('/customer/dashboard/home');

        $response->assertStatus(200)
            ->assertViewIs('customer.dashboard.home') // Sesuaikan dengan view Anda
            ->assertSeeText('Hi, Selamat Pagi');
    }

    /** @test */
    public function dashboard_shows_products()
    {
        // Buat produk milik customer ini
        $product = Produk::factory()
            ->create(['id_user' => $this->customer->id]);

        $response = $this->actingAs($this->customer)
            ->get('/customer/dashboard/home');

        $response->assertSeeText($product->nama);
    }

    /** @test */
    public function dashboard_shows_rentals()
    {
        // Buat penyewaan
        $rental = Penyewaan::factory()
            ->create(['id_user' => $this->customer->id]);

        // Buat detail penyewaan
        $product = Produk::factory()
            ->create(['id_user' => $this->customer->id]);

        DetailPenyewaan::factory()
            ->create([
                'id_penyewaan' => $rental->id,
                'id_produk' => $product->id,
                'warna_produk'=> 'merah',
                'ukuran'=> 'L',
                'qty'=> '5',
                'subtotal'=> '400000',
            ]);

        $response = $this->actingAs($this->customer)
            ->get('/customer/dashboard/home');

        $response->assertSeeText($rental->nama_penyewa);
    }
}