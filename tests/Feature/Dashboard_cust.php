<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Produk;
use App\Models\Penyewaan;
use App\Models\DetailPenyewaan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class Dashboard_Cust extends TestCase
{
    use RefreshDatabase;

    protected $customer;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat customer dummy
        $this->customer = User::factory()->create([
            'name' => 'John Customer',
            'role' => 'customer',
            'foto' => 'profile/default.jpg'
        ]);
    }

    /** @test */
    public function dashboard_displays_income_comparison_data()
    {
        $response = $this->actingAs($this->customer)
                        ->get('/dashboard');

        // Test annual comparison
        $response->assertSeeText('Total Pemasukan Pertahun')
                ->assertSee('Rp.'); // Format nominal

        // Test monthly comparison
        $response->assertSeeText('Total Pemasukan Perbulan')
                ->assertSee('Rp.');
    }

    /** @test */
    public function dashboard_displays_top_products()
    {
        // Create products
        $products = Produk::factory()
                        ->count(3)
                        ->create(['status' => 'Tersedia']);

        // Create some rental details for these products
        $penyewaan = Penyewaan::factory()->create(['id_user' => $this->customer->id]);
        
        foreach ($products as $product) {
            DetailPenyewaan::factory()
                ->create([
                    'id_penyewaan' => $penyewaan->id,
                    'id_produk' => $product->id
                ]);
        }

        $response = $this->actingAs($this->customer)
                        ->get('/dashboard');

        $response->assertSeeText('Peralatan Terlaris');
        
        foreach ($products as $product) {
            $response->assertSeeText($product->nama)
                    ->assertSeeText(Str::limit($product->deskripsi, 50));
        }
    }

    /** @test */
    public function dashboard_shows_empty_state_when_no_top_products()
    {
        $response = $this->actingAs($this->customer)
                        ->get('/dashboard');

        $response->assertSeeText('Tidak ada produk terlaris');
    }

    /** @test */
    public function dashboard_displays_rental_status_sections()
    {
        // Create rental data
        $activeRental = Penyewaan::factory()
                        ->create([
                            'id_user' => $this->customer->id,
                            'status_penyewaan' => 'berlangsung'
                        ]);
        
        $completedRental = Penyewaan::factory()
                        ->create([
                            'id_user' => $this->customer->id,
                            'status_penyewaan' => 'selesai'
                        ]);
        
        // Untuk penyewa telat, perlu disesuaikan dengan logika aplikasi
        // Diasumsikan ada field hari_telat atau bisa dihitung dari tanggal

        $response = $this->actingAs($this->customer)
                        ->get('/dashboard');

        // Test active rentals
        $response->assertSeeText('Penyewa Berlangsung')
                ->assertSeeText($activeRental->user->name)
                ->assertSeeText('Berlangsung');

        // Test completed rentals
        $response->assertSeeText('Riwayat Penyewa')
                ->assertSeeText($completedRental->user->name)
                ->assertSeeText('Selesai');
    }

    /** @test */
    public function dashboard_shows_empty_states_for_rental_sections()
    {
        $response = $this->actingAs($this->customer)
                        ->get('/dashboard');

        $response->assertSeeText('Tidak ada penyewa aktif')
                ->assertSeeText('Belum ada penyewa');
                // Penyesuaian untuk telat bisa ditambahkan
    }
}