<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RoomCrudTest extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $nodeId = 1;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin user
        $this->admin = User::factory()->create();

        // Create seed node for foreign key dependency
        DB::table('nodes')->insert([
            'id' => $this->nodeId,
            'name' => 'Lobby Utama',
            'floor' => 1,
            'lat' => 120,
            'lng' => 240,
        ]);
    }

    /**
     * Test guest cannot access rooms index.
     */
    public function test_guest_cannot_access_rooms(): void
    {
        $response = $this->get('/admin/ruangan');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test admin can view rooms index page.
     */
    public function test_admin_can_view_rooms(): void
    {
        DB::table('ruangan')->insert([
            'kode_ruangan' => 'R001',
            'id_node' => $this->nodeId,
            'nama_ruangan' => 'Ruang Teater',
            'deskripsi' => 'Ruang seminar teater lantai 1',
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/ruangan');

        $response->assertStatus(200);
        $response->assertSee('Ruangan');
        $response->assertSee('Ruang Teater');
        $response->assertSee('Tambah Ruangan');
    }

    /**
     * Test admin can create a room.
     */
    public function test_admin_can_create_room(): void
    {
        $payload = [
            'kode_ruangan' => 'R002',
            'id_node' => $this->nodeId,
            'nama_ruangan' => 'Ruang Kelas A',
            'deskripsi' => 'Ruang kelas kapasitas 40 orang',
        ];

        $response = $this->actingAs($this->admin)->post('/admin/ruangan', $payload);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/ruangan');
        $response->assertSessionHas('success', 'Ruangan berhasil ditambahkan!');

        $this->assertDatabaseHas('ruangan', [
            'kode_ruangan' => 'R002',
            'nama_ruangan' => 'Ruang Kelas A',
        ]);
    }

    /**
     * Test duplicate room code validation.
     */
    public function test_admin_cannot_create_duplicate_room_code(): void
    {
        DB::table('ruangan')->insert([
            'kode_ruangan' => 'R001',
            'id_node' => $this->nodeId,
            'nama_ruangan' => 'Ruang Teater',
            'deskripsi' => 'Ruang teater',
        ]);

        $payload = [
            'kode_ruangan' => 'R001', // duplicate
            'id_node' => $this->nodeId,
            'nama_ruangan' => 'Ruang Lain',
            'deskripsi' => 'Deskripsi lain',
        ];

        $response = $this->actingAs($this->admin)->post('/admin/ruangan', $payload);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('kode_ruangan');
    }

    /**
     * Test admin can update a room.
     */
    public function test_admin_can_update_room(): void
    {
        DB::table('ruangan')->insert([
            'kode_ruangan' => 'R001',
            'id_node' => $this->nodeId,
            'nama_ruangan' => 'Ruang Teater',
            'deskripsi' => 'Ruang teater',
        ]);

        $payload = [
            'id_node' => $this->nodeId,
            'nama_ruangan' => 'Ruang Teater Baru',
            'deskripsi' => 'Deskripsi ruang teater baru',
        ];

        $response = $this->actingAs($this->admin)->put('/admin/ruangan/R001', $payload);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/ruangan');
        $response->assertSessionHas('success', 'Ruangan berhasil diperbarui!');

        $this->assertDatabaseHas('ruangan', [
            'kode_ruangan' => 'R001',
            'nama_ruangan' => 'Ruang Teater Baru',
            'deskripsi' => 'Deskripsi ruang teater baru',
        ]);
    }

    /**
     * Test admin can delete a room.
     */
    public function test_admin_can_delete_room(): void
    {
        DB::table('ruangan')->insert([
            'kode_ruangan' => 'R001',
            'id_node' => $this->nodeId,
            'nama_ruangan' => 'Ruang Teater',
            'deskripsi' => 'Ruang teater',
        ]);

        $response = $this->actingAs($this->admin)->delete('/admin/ruangan/R001');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/ruangan');
        $response->assertSessionHas('success', 'Ruangan berhasil dihapus!');

        $this->assertDatabaseMissing('ruangan', [
            'kode_ruangan' => 'R001',
        ]);
    }
}
