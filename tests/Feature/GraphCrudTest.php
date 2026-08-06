<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class GraphCrudTest extends TestCase
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
     * Test guest is redirected.
     */
    public function test_guest_cannot_access_graph(): void
    {
        $response = $this->get('/admin/graph');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test admin can view graph page.
     */
    public function test_admin_can_view_graph(): void
    {
        DB::table('nodes')->insert([
            'id' => 1,
            'name' => 'Node A',
            'floor' => 1,
            'lat' => 100,
            'lng' => 200,
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/graph');

        $response->assertStatus(200);
        $response->assertSee('Graph Management');
        $response->assertSee('Node A');
    }

    /**
     * Test node CRUD - Store.
     */
    public function test_admin_can_create_node(): void
    {
        $payload = [
            'name' => 'Node B',
            'floor' => 2,
            'lat' => 150,
            'lng' => 250,
        ];

        $response = $this->actingAs($this->admin)->post('/admin/nodes', $payload);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/graph');
        $response->assertSessionHas('success', 'Node berhasil ditambahkan!');

        $this->assertDatabaseHas('nodes', [
            'name' => 'Node B',
            'floor' => 2,
        ]);
    }

    /**
     * Test node CRUD - Update.
     */
    public function test_admin_can_update_node(): void
    {
        DB::table('nodes')->insert([
            'id' => 5,
            'name' => 'Old Node',
            'floor' => 1,
            'lat' => 100,
            'lng' => 200,
        ]);

        $payload = [
            'name' => 'Updated Node',
            'floor' => 2,
            'lat' => 110,
            'lng' => 210,
        ];

        $response = $this->actingAs($this->admin)->put('/admin/nodes/5', $payload);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/graph');
        $response->assertSessionHas('success', 'Node berhasil diperbarui!');

        $this->assertDatabaseHas('nodes', [
            'id' => 5,
            'name' => 'Updated Node',
            'floor' => 2,
        ]);
    }

    /**
     * Test node CRUD - Delete.
     */
    public function test_admin_can_delete_node(): void
    {
        DB::table('nodes')->insert([
            'id' => 5,
            'name' => 'Node to Delete',
            'floor' => 1,
            'lat' => 100,
            'lng' => 200,
        ]);

        $response = $this->actingAs($this->admin)->delete('/admin/nodes/5');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/graph');
        $response->assertSessionHas('success', 'Node berhasil dihapus!');

        $this->assertDatabaseMissing('nodes', [
            'id' => 5,
        ]);
    }

    /**
     * Test edge CRUD - Store.
     */
    public function test_admin_can_create_edge(): void
    {
        DB::table('nodes')->insert([
            ['id' => 10, 'name' => 'Node A', 'floor' => 1, 'lat' => 100, 'lng' => 200],
            ['id' => 20, 'name' => 'Node B', 'floor' => 1, 'lat' => 120, 'lng' => 220],
        ]);

        $payload = [
            'from_node_id' => 10,
            'to_node_id' => 20,
            'weight' => 15,
            'is_stairs' => 0,
        ];

        $response = $this->actingAs($this->admin)->post('/admin/edges', $payload);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/graph');
        $response->assertSessionHas('success', 'Edge berhasil ditambahkan!');

        $this->assertDatabaseHas('edges', [
            'from_node_id' => 10,
            'to_node_id' => 20,
            'weight' => 15,
        ]);
    }

    /**
     * Test edge CRUD - Update.
     */
    public function test_admin_can_update_edge(): void
    {
        DB::table('nodes')->insert([
            ['id' => 10, 'name' => 'Node A', 'floor' => 1, 'lat' => 100, 'lng' => 200],
            ['id' => 20, 'name' => 'Node B', 'floor' => 1, 'lat' => 120, 'lng' => 220],
        ]);

        DB::table('edges')->insert([
            'id' => 8,
            'from_node_id' => 10,
            'to_node_id' => 20,
            'weight' => 15,
            'is_stairs' => false,
        ]);

        $payload = [
            'from_node_id' => 10,
            'to_node_id' => 20,
            'weight' => 25,
            'is_stairs' => 1,
        ];

        $response = $this->actingAs($this->admin)->put('/admin/edges/8', $payload);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/graph');
        $response->assertSessionHas('success', 'Edge berhasil diperbarui!');

        $this->assertDatabaseHas('edges', [
            'id' => 8,
            'weight' => 25,
            'is_stairs' => 1,
        ]);
    }

    /**
     * Test edge CRUD - Delete.
     */
    public function test_admin_can_delete_edge(): void
    {
        DB::table('nodes')->insert([
            ['id' => 10, 'name' => 'Node A', 'floor' => 1, 'lat' => 100, 'lng' => 200],
            ['id' => 20, 'name' => 'Node B', 'floor' => 1, 'lat' => 120, 'lng' => 220],
        ]);

        DB::table('edges')->insert([
            'id' => 8,
            'from_node_id' => 10,
            'to_node_id' => 20,
            'weight' => 15,
            'is_stairs' => false,
        ]);

        $response = $this->actingAs($this->admin)->delete('/admin/edges/8');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/graph');
        $response->assertSessionHas('success', 'Edge berhasil dihapus!');

        $this->assertDatabaseMissing('edges', [
            'id' => 8,
        ]);
    }

    /**
     * Test cascade delete on node.
     */
    public function test_deleting_node_cascades_delete_edges(): void
    {
        DB::table('nodes')->insert([
            ['id' => 10, 'name' => 'Node A', 'floor' => 1, 'lat' => 100, 'lng' => 200],
            ['id' => 20, 'name' => 'Node B', 'floor' => 1, 'lat' => 120, 'lng' => 220],
        ]);

        DB::table('edges')->insert([
            'id' => 8,
            'from_node_id' => 10,
            'to_node_id' => 20,
            'weight' => 15,
            'is_stairs' => false,
        ]);

        // Delete from_node_id (Node A with ID 10)
        $response = $this->actingAs($this->admin)->delete('/admin/nodes/10');

        $response->assertStatus(302);

        // Edge 8 should be automatically removed due to Cascade onDelete constraint
        $this->assertDatabaseMissing('edges', [
            'id' => 8,
        ]);
    }
}
