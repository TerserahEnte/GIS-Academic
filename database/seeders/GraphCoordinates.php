<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GraphCoordinates extends Seeder
{
    public function run()
    {
        // 1. INSERT NODES (Rooms, Intersections, Stairs)
        $nodes = [
            // Entrances & Stairs
            ['id' => 1, 'name' => 'Pintu Belakang L1', 'floor' => 1, 'lat' => 510, 'lng' => 1140],
            ['id' => 11, 'name' => 'Tangga Kiri', 'floor' => 1, 'lat' => 450, 'lng' => 330],
            
            // The Main Hallway Loop (Clockwise around Taman)
            ['id' => 2, 'name' => 'Hallway Bot-Right', 'floor' => 1, 'lat' => 570, 'lng' => 1140],
            ['id' => 7, 'name' => 'Hallway Bot-Mid', 'floor' => 1, 'lat' => 570, 'lng' => 750],
            ['id' => 6, 'name' => 'Hallway Bot-Left', 'floor' => 1, 'lat' => 570, 'lng' => 330],
            ['id' => 5, 'name' => 'Hallway Top-Left', 'floor' => 1, 'lat' => 810, 'lng' => 330],
            ['id' => 4, 'name' => 'Hallway Top-Mid', 'floor' => 1, 'lat' => 810, 'lng' => 750],
            ['id' => 3, 'name' => 'Hallway Top-Right', 'floor' => 1, 'lat' => 810, 'lng' => 1140],

            // Room Doors
            ['id' => 8, 'name' => 'R. Kelas 111', 'floor' => 1, 'lat' => 650, 'lng' => 1260],
            ['id' => 9, 'name' => 'R. Rapat Prodi', 'floor' => 1, 'lat' => 900, 'lng' => 750],
            ['id' => 10, 'name' => 'R. Serbaguna', 'floor' => 1, 'lat' => 650, 'lng' => 200],
        ];

        DB::table('nodes')->insert($nodes);

        // 2. INSERT EDGES (The connections and weights)
        $edges = [
            // Entrance to Hallway
            ['from_node_id' => 1, 'to_node_id' => 2, 'weight' => 60, 'is_stairs' => false],
            
            // Hallway Loop (Bidirectional assumed by your Dijkstra, but defining one-way here for simplicity)
            ['from_node_id' => 2, 'to_node_id' => 7, 'weight' => 390, 'is_stairs' => false],
            ['from_node_id' => 7, 'to_node_id' => 6, 'weight' => 420, 'is_stairs' => false],
            ['from_node_id' => 6, 'to_node_id' => 5, 'weight' => 240, 'is_stairs' => false],
            ['from_node_id' => 5, 'to_node_id' => 4, 'weight' => 420, 'is_stairs' => false],
            ['from_node_id' => 4, 'to_node_id' => 3, 'weight' => 390, 'is_stairs' => false],
            ['from_node_id' => 3, 'to_node_id' => 2, 'weight' => 240, 'is_stairs' => false], // Completes loop

            // Hallways to Rooms
            ['from_node_id' => 2, 'to_node_id' => 8, 'weight' => 144, 'is_stairs' => false], // To R. 111
            ['from_node_id' => 4, 'to_node_id' => 9, 'weight' => 90, 'is_stairs' => false],  // To Rapat Prodi
            ['from_node_id' => 6, 'to_node_id' => 10, 'weight' => 152, 'is_stairs' => false], // To Serbaguna
            ['from_node_id' => 6, 'to_node_id' => 11, 'weight' => 120, 'is_stairs' => true],  // To Stairs
        ];

        // If your Dijkstra requires explicit bidirectional edges in the DB, duplicate the array in reverse:
        $bidirectionalEdges = [];
        foreach ($edges as $edge) {
            $bidirectionalEdges[] = $edge;
            $bidirectionalEdges[] = [
                'from_node_id' => $edge['to_node_id'],
                'to_node_id' => $edge['from_node_id'],
                'weight' => $edge['weight'],
                'is_stairs' => $edge['is_stairs'],
            ];
        }

        DB::table('edges')->insert($bidirectionalEdges);
    }
}
