<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LecturerCrudTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin user
        $this->admin = User::factory()->create();
    }

    /**
     * Test guest cannot access lecturers index.
     */
    public function test_guest_cannot_access_lecturers(): void
    {
        $response = $this->get('/admin/dosen');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test admin can view lecturers index.
     */
    public function test_admin_can_view_lecturers(): void
    {
        DB::table('dosen')->insert([
            'kode_dosen' => 'D001',
            'nama_dosen' => 'Prof. Haryono',
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/dosen');

        $response->assertStatus(200);
        $response->assertSee('Dosen');
        $response->assertSee('Prof. Haryono');
        $response->assertSee('Tambah Dosen');
    }

    /**
     * Test admin can create a lecturer.
     */
    public function test_admin_can_create_lecturer(): void
    {
        $payload = [
            'kode_dosen' => 'D002',
            'nama_dosen' => 'Dr. Rina Wijaya',
        ];

        $response = $this->actingAs($this->admin)->post('/admin/dosen', $payload);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/dosen');
        $response->assertSessionHas('success', 'Dosen berhasil ditambahkan!');

        $this->assertDatabaseHas('dosen', [
            'kode_dosen' => 'D002',
            'nama_dosen' => 'Dr. Rina Wijaya',
        ]);
    }

    /**
     * Test duplicate code_dosen validation.
     */
    public function test_admin_cannot_create_duplicate_lecturer_code(): void
    {
        DB::table('dosen')->insert([
            'kode_dosen' => 'D001',
            'nama_dosen' => 'Prof. Haryono',
        ]);

        $payload = [
            'kode_dosen' => 'D001', // duplicate
            'nama_dosen' => 'Nama Lain',
        ];

        $response = $this->actingAs($this->admin)->post('/admin/dosen', $payload);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('kode_dosen');
    }

    /**
     * Test admin can update a lecturer.
     */
    public function test_admin_can_update_lecturer(): void
    {
        DB::table('dosen')->insert([
            'kode_dosen' => 'D001',
            'nama_dosen' => 'Prof. Haryono',
        ]);

        $payload = [
            'nama_dosen' => 'Prof. Haryono M.Sc',
        ];

        $response = $this->actingAs($this->admin)->put('/admin/dosen/D001', $payload);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/dosen');
        $response->assertSessionHas('success', 'Dosen berhasil diperbarui!');

        $this->assertDatabaseHas('dosen', [
            'kode_dosen' => 'D001',
            'nama_dosen' => 'Prof. Haryono M.Sc',
        ]);
    }

    /**
     * Test admin can delete a lecturer.
     */
    public function test_admin_can_delete_lecturer(): void
    {
        DB::table('dosen')->insert([
            'kode_dosen' => 'D001',
            'nama_dosen' => 'Prof. Haryono',
        ]);

        $response = $this->actingAs($this->admin)->delete('/admin/dosen/D001');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/dosen');
        $response->assertSessionHas('success', 'Dosen berhasil dihapus!');

        $this->assertDatabaseMissing('dosen', [
            'kode_dosen' => 'D001',
        ]);
    }
}
