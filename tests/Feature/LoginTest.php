<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Mock Vite
        $this->mockVite();
    }
    
    protected function mockVite()
    {
        // Mock the Vite facade
        \Illuminate\Support\Facades\Vite::shouldReceive('__invoke')
            ->andReturn('');
            
        \Illuminate\Support\Facades\Vite::shouldReceive('asset')
            ->andReturn('');
    }

    /** @test */
    public function bisa_menampilkan_halaman_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login');
        $response->assertSee('Masukkan Email atau nomor Telfon');
        $response->assertSee('Masukkan password');
    }

    /** @test */
    public function users_bisa_login_dengan_email()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'nomor_telfon' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect();
    }

    /** @test */
    public function users_bisa_login_dengan_nomor_handphone()
    {
        $user = User::factory()->create([
            'nomor_telephone' => '081234567890',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'nomor_telfon' => '081234567890',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect();
    }

    /** @test */
    public function user_redirected_ke_developer_dashboard_jika_type_1()
    {
        $user = User::factory()->admin()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'nomor_telfon' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/developer/dashboard/home');
    }

    /** @test */
    public function user_redirected_ke_customer_dashboard_jika_type_0()
    {
        $user = User::factory()->customer()->create([
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'nomor_telfon' => 'customer@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard-cust'));
    }

    /** @test */
    public function user_tidak_bisa_login_dengan_akun_yang_salah()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'nomor_telfon' => 'test@example.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('nomor_telfon');
    }

    /** @test */
    public function user_yang_diblokir_tidak_bisa_login()
    {
        $user = User::factory()->create([
            'email' => 'blocked@example.com',
            'password' => bcrypt('password'),
            'SP' => 3, // Blocked user
        ]);

        $response = $this->post('/login', [
            'nomor_telfon' => 'blocked@example.com',
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error');
    }

    /** @test */
    public function validate_required_fields()
    {
        $response = $this->post('/login', [
            'nomor_telfon' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['nomor_telfon', 'password']);
    }

    /** @test */
    public function authenticated_user_logout()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->post('/logout');

        $this->assertGuest();
        $response->assertRedirect(route('login'));
    }
}