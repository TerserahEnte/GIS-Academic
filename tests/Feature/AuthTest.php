<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest is redirected to login page.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test login page returns successful response.
     */
    public function test_login_page_loads_successfully(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('LOGIN');
    }

    /**
     * Test login with invalid credentials.
     */
    public function test_login_fails_with_invalid_credentials(): void
    {
        $response = $this->post('/admin/login', [
            'username' => 'wronguser',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('username');
        $this->assertGuest();
    }

    /**
     * Test login with valid email credentials.
     */
    public function test_login_succeeds_with_valid_email(): void
    {
        $user = User::factory()->create([
            'name' => 'kayagi',
            'email' => 'kayagi@example.com',
            'password' => bcrypt('Faiqnh123'),
        ]);

        $response = $this->post('/admin/login', [
            'username' => 'kayagi@example.com',
            'password' => 'Faiqnh123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test login with valid username (name) credentials.
     */
    public function test_login_succeeds_with_valid_username(): void
    {
        $user = User::factory()->create([
            'name' => 'kayagi',
            'email' => 'kayagi@example.com',
            'password' => bcrypt('Faiqnh123'),
        ]);

        $response = $this->post('/admin/login', [
            'username' => 'kayagi',
            'password' => 'Faiqnh123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test authenticated user can access admin dashboard.
     */
    public function test_authenticated_user_can_access_admin(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Jadwal');
    }

    /**
     * Test logout process.
     */
    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/logout');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}
