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
            // ['id' => 1, 'name' => 'Pintu Belakang L1', 'floor' => 1, 'lat' => 510, 'lng' => 1140],
            // ['id' => 11, 'name' => 'Tangga Kiri', 'floor' => 1, 'lat' => 450, 'lng' => 330],
            
            // // The Main Hallway Loop (Clockwise around Taman)
            // ['id' => 2, 'name' => 'Hallway Bot-Right', 'floor' => 1, 'lat' => 570, 'lng' => 1140],
            // ['id' => 7, 'name' => 'Hallway Bot-Mid', 'floor' => 1, 'lat' => 570, 'lng' => 750],
            // ['id' => 6, 'name' => 'Hallway Bot-Left', 'floor' => 1, 'lat' => 570, 'lng' => 330],
            // ['id' => 5, 'name' => 'Hallway Top-Left', 'floor' => 1, 'lat' => 810, 'lng' => 330],
            // ['id' => 4, 'name' => 'Hallway Top-Mid', 'floor' => 1, 'lat' => 810, 'lng' => 750],
            // ['id' => 3, 'name' => 'Hallway Top-Right', 'floor' => 1, 'lat' => 810, 'lng' => 1140],

            // // Room Doors
            // ['id' => 8, 'name' => 'R. Kelas 111', 'floor' => 1, 'lat' => 650, 'lng' => 1260],
            // ['id' => 9, 'name' => 'R. Rapat Prodi', 'floor' => 1, 'lat' => 900, 'lng' => 750],
            // ['id' => 10, 'name' => 'R. Serbaguna', 'floor' => 1, 'lat' => 650, 'lng' => 200],

            ['id' => 1, 'name' => 'Pintu Belakang L1', 'floor' => 1, 'lat' => 510, 'lng' => 1140],
            ['id' => 2, 'name' => 'Hallway Bot-Right', 'floor' => 1, 'lat' => 507, 'lng' => 1016],
            ['id' => 3, 'name' => 'Hallway Top-Right', 'floor' => 1, 'lat' => 780, 'lng' => 1109],
            ['id' => 4, 'name' => 'Hallway Top-Mid', 'floor' => 1, 'lat' => 780, 'lng' => 870],
            ['id' => 5, 'name' => 'Hallway Top-Left', 'floor' => 1, 'lat' => 780, 'lng' => 330],
            ['id' => 6, 'name' => 'Hallway Bot-Left', 'floor' => 1, 'lat' => 510, 'lng' => 330],
            ['id' => 7, 'name' => 'Hallway Bot-Mid', 'floor' => 1, 'lat' => 515, 'lng' => 869],
            ['id' => 8, 'name' => 'R. Kelas 111', 'floor' => 1, 'lat' => 650, 'lng' => 1260],
            ['id' => 9, 'name' => 'R. Rapat Prodi', 'floor' => 1, 'lat' => 900, 'lng' => 750],
            ['id' => 10, 'name' => 'R. Serbaguna', 'floor' => 1, 'lat' => 650, 'lng' => 200],
            ['id' => 11, 'name' => 'Tangga Kiri', 'floor' => 1, 'lat' => 543, 'lng' => 391],
            ['id' => 12, 'name' => 'Tangga Kanan', 'floor' => 1, 'lat' => 810, 'lng' => 1228],


            ['id' => 13, 'name' => 'Tangga Kanan', 'floor' => 2, 'lat' => 850, 'lng' => 1201],
            ['id' => 14, 'name' => 'Hallway Top-Right', 'floor' => 2, 'lat' => 826, 'lng' => 1049],
            ['id' => 15, 'name' => 'Hallway Top-Middle', 'floor' => 2, 'lat' => 825, 'lng' => 838],
            ['id' => 16, 'name' => 'Hallway Top-Left', 'floor' => 2, 'lat' => 825, 'lng' => 291],
            ['id' => 17, 'name' => 'Hallway Bottom-Left', 'floor' => 2, 'lat' => 554, 'lng' => 291],
            ['id' => 18, 'name' => 'Hallway Bottom-Middle', 'floor' => 2, 'lat' => 554, 'lng' => 838],
            ['id' => 19, 'name' => 'Tangga Kiri', 'floor' => 2, 'lat' => 580, 'lng' => 351],
            ['id' => 20, 'name' => 'Pintu Masuk L2', 'floor' => 2, 'lat' => 505, 'lng' => 290],
            
            

        ];

        DB::table('nodes')->insert($nodes);

        // 2. INSERT EDGES (The connections and weights)
        $edges = [
            // Lantai 1
            ['from_node_id' => 1, 'to_node_id' => 2, 'weight' => 60, 'is_stairs' => 0],

            ['from_node_id' => 2, 'to_node_id' => 7, 'weight' => 390, 'is_stairs' => 0],

            ['from_node_id' => 7, 'to_node_id' => 6, 'weight' => 420, 'is_stairs' => 0],

            ['from_node_id' => 6, 'to_node_id' => 5, 'weight' => 240, 'is_stairs' => 0],

            ['from_node_id' => 5, 'to_node_id' => 4, 'weight' => 420, 'is_stairs' => 0],

            ['from_node_id' => 4, 'to_node_id' => 3, 'weight' => 390, 'is_stairs' => 0],

            ['from_node_id' => 4, 'to_node_id' => 9, 'weight' => 90, 'is_stairs' => 0],

            ['from_node_id' => 5, 'to_node_id' => 10, 'weight' => 20, 'is_stairs' => 0],
            ['from_node_id' => 6, 'to_node_id' => 10, 'weight' => 152, 'is_stairs' => 0],

            ['from_node_id' => 6, 'to_node_id' => 11, 'weight' => 120, 'is_stairs' => 1],

            ['from_node_id' => 3, 'to_node_id' => 8, 'weight' => 60, 'is_stairs' => 0],
            ['from_node_id' => 12, 'to_node_id' => 8, 'weight' => 30, 'is_stairs' => 0],

            ['from_node_id' => 7, 'to_node_id' => 4, 'weight' => 240, 'is_stairs' => 0],
            ['from_node_id' => 3, 'to_node_id' => 12, 'weight' => 160, 'is_stairs' => 1],

            // Connect Lantai 1 to 2
            ['from_node_id' => 12, 'to_node_id' => 13, 'weight' => 400, 'is_stairs' => 1],
            ['from_node_id' => 11, 'to_node_id' => 19, 'weight' => 400, 'is_stairs' => 1],


            // Lantai 2
            ['from_node_id' => 14, 'to_node_id' => 13, 'weight' => 120, 'is_stairs' => 1],
            ['from_node_id' => 15, 'to_node_id' => 14, 'weight' => 180, 'is_stairs' => 0],
            ['from_node_id' => 15, 'to_node_id' => 18, 'weight' => 240, 'is_stairs' => 0],
            ['from_node_id' => 15, 'to_node_id' => 16, 'weight' => 420, 'is_stairs' => 0],
            ['from_node_id' => 18, 'to_node_id' => 17, 'weight' => 420, 'is_stairs' => 0],
            ['from_node_id' => 16, 'to_node_id' => 17, 'weight' => 240, 'is_stairs' => 0],
            ['from_node_id' => 17, 'to_node_id' => 19, 'weight' => 60, 'is_stairs' => 1],
            ['from_node_id' => 17, 'to_node_id' => 20, 'weight' => 20, 'is_stairs' => 0],
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
