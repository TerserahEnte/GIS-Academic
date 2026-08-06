<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ScheduleCrudTest extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $roomCode = 'R001';
    private $lecturerCode = 'D001';

    protected function setUp(): void
    {
        parent::setUp();

        // Create an admin user
        $this->admin = User::factory()->create();

        // Seed dependency tables for foreign keys
        DB::table('nodes')->insert([
            'id' => 1,
            'name' => 'Lobby',
            'floor' => 1,
            'lat' => 100,
            'lng' => 200,
        ]);

        DB::table('ruangan')->insert([
            'kode_ruangan' => $this->roomCode,
            'id_node' => 1,
            'nama_ruangan' => 'Ruangan 101',
            'deskripsi' => 'Ruang kuliah 101',
        ]);

        DB::table('dosen')->insert([
            'kode_dosen' => $this->lecturerCode,
            'nama_dosen' => 'Dr. Budi Santoso',
        ]);
    }

    /**
     * Test guest cannot access admin dashboard.
     */
    public function test_guest_cannot_access_schedules(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test admin can view schedules index.
     */
    public function test_admin_can_view_schedules(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Jadwal');
        $response->assertSee('Tambah Jadwal');
    }

    /**
     * Test admin can create a schedule.
     */
    public function test_admin_can_create_schedule(): void
    {
        $payload = [
            'kode_jadwal' => 'J001',
            'kode_ruangan' => $this->roomCode,
            'kode_dosen' => $this->lecturerCode,
            'nama_matkul' => 'Pemrograman Web',
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '09:40',
        ];

        $response = $this->actingAs($this->admin)->post('/admin/jadwal', $payload);

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $response->assertSessionHas('success', 'Jadwal berhasil ditambahkan!');

        $this->assertDatabaseHas('jadwal', [
            'kode_jadwal' => 'J001',
            'nama_matkul' => 'Pemrograman Web',
        ]);
    }

    /**
     * Test admin cannot create schedule with duplicate code.
     */
    public function test_admin_cannot_create_duplicate_schedule_code(): void
    {
        // First insert
        DB::table('jadwal')->insert([
            'kode_jadwal' => 'J001',
            'kode_ruangan' => $this->roomCode,
            'kode_dosen' => $this->lecturerCode,
            'nama_matkul' => 'Mata Kuliah A',
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '09:40',
        ]);

        $payload = [
            'kode_jadwal' => 'J001', // duplicate
            'kode_ruangan' => $this->roomCode,
            'kode_dosen' => $this->lecturerCode,
            'nama_matkul' => 'Mata Kuliah B',
            'hari' => 'Selasa',
            'jam_mulai' => '10:00',
            'jam_selesai' => '11:40',
        ];

        $response = $this->actingAs($this->admin)->post('/admin/jadwal', $payload);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('kode_jadwal');
    }

    /**
     * Test admin can update a schedule.
     */
    public function test_admin_can_update_schedule(): void
    {
        DB::table('jadwal')->insert([
            'kode_jadwal' => 'J001',
            'kode_ruangan' => $this->roomCode,
            'kode_dosen' => $this->lecturerCode,
            'nama_matkul' => 'Pemrograman Web',
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '09:40',
        ]);

        $payload = [
            'kode_ruangan' => $this->roomCode,
            'kode_dosen' => $this->lecturerCode,
            'nama_matkul' => 'Pemrograman Web Revisi',
            'hari' => 'Rabu',
            'jam_mulai' => '13:00',
            'jam_selesai' => '14:40',
        ];

        $response = $this->actingAs($this->admin)->put('/admin/jadwal/J001', $payload);

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $response->assertSessionHas('success', 'Jadwal berhasil diperbarui!');

        $this->assertDatabaseHas('jadwal', [
            'kode_jadwal' => 'J001',
            'nama_matkul' => 'Pemrograman Web Revisi',
            'hari' => 'Rabu',
        ]);
    }

    /**
     * Test admin can delete a schedule.
     */
    public function test_admin_can_delete_schedule(): void
    {
        DB::table('jadwal')->insert([
            'kode_jadwal' => 'J001',
            'kode_ruangan' => $this->roomCode,
            'kode_dosen' => $this->lecturerCode,
            'nama_matkul' => 'Pemrograman Web',
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '09:40',
        ]);

        $response = $this->actingAs($this->admin)->delete('/admin/jadwal/J001');

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $response->assertSessionHas('success', 'Jadwal berhasil dihapus!');

        $this->assertDatabaseMissing('jadwal', [
            'kode_jadwal' => 'J001',
        ]);
    }
}
