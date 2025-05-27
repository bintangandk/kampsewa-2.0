<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Produk;
use App\Models\Penyewaan;
use App\Models\DetailPenyewaan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class DashboardCustomerTest extends TestCase
{
    use RefreshDatabase;

    protected $customer;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat customer dummy sesuai dengan UserFactory
        $this->customer = User::factory()->create([
            'name' => 'John Customer',
            'type' => 0, // 0 untuk customer
            'foto' => 'profile/default.jpg',
            'status' => 'Online'
        ]);
    }

    /** @test */
    public function only_authenticated_customers_can_access_dashboard()
    {
        // Guest cannot access
        $this->get('/dashboard')->assertRedirect('/login');

        // Non-customer cannot access (type 1 untuk non-customer)
        $admin = User::factory()->create(['type' => 1]);
        $this->actingAs($admin)->get('/dashboard')->assertForbidden();

        // Customer can access
        $response = $this->actingAs($this->customer)
                        ->get('/dashboard');
        
        $response->assertStatus(200)
                ->assertViewIs('dashboard')
                ->assertSeeText('Hi, Selamat Pagi John Customer');
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

        // Create rental
        $penyewaan = Penyewaan::factory()
                        ->create(['id_user' => $this->customer->id]);
        
        // Create rental details
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
        // Create active rental
        $activeRental = Penyewaan::factory()
                        ->create([
                            'id_user' => $this->customer->id,
                            'status_penyewaan' => 'berlangsung'
                        ]);
        
        // Create completed rental
        $completedRental = Penyewaan::factory()
                        ->create([
                            'id_user' => $this->customer->id,
                            'status_penyewaan' => 'selesai'
                        ]);
        
        // Create late rental (asumsi ada field hari_telat)
        $lateRental = Penyewaan::factory()
                        ->create([
                            'id_user' => $this->customer->id,
                            'status_penyewaan' => 'berlangsung',
                            'hari_telat' => 3 // Jika ada field ini
                        ]);

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

        // Test late rentals (jika ada di view)
        $response->assertSeeText('Denda Penyewa')
                ->assertSeeText($lateRental->user->name)
                ->assertSeeText('3 Hari');
    }

    /** @test */
    public function dashboard_shows_empty_states_for_rental_sections()
    {
        $response = $this->actingAs($this->customer)
                        ->get('/dashboard');

        $response->assertSeeText('Tidak ada penyewa aktif')
                ->assertSeeText('Belum ada penyewa')
                ->assertSeeText('Tidak ada penyewa yang telat saat ini');
    }
}