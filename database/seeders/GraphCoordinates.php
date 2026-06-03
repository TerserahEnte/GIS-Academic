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

            // Entrances
            ['id' => 1, 'name' => 'Pintu Utama', 'floor' => 1, 'lat' => 138, 'lng' => 1681],
            ['id' => 2, 'name' => 'Pintu Barat', 'floor' => 1, 'lat' => 196, 'lng' => 52],
            ['id' => 3, 'name' => 'Pintu Utara', 'floor' => 1, 'lat' => 954, 'lng' => 724],

            // Facilities
            ['id' => 4, 'name' => 'Elevator', 'floor' => 1, 'lat' => 759, 'lng' => 126],
            ['id' => 5, 'name' => 'Ruangan 103', 'floor' => 1, 'lat' => 413, 'lng' => 196],
            ['id' => 6, 'name' => 'Ruangan 102', 'floor' => 1, 'lat' => 512, 'lng' => 1477],
            ['id' => 7, 'name' => 'Ruangan 101', 'floor' => 1, 'lat' => 600, 'lng' => 1477],
            ['id' => 8, 'name' => 'Gudang', 'floor' => 1, 'lat' => 911, 'lng' => 1682],

            // Toilets
            ['id' => 9, 'name' => 'Toilet Laki-laki', 'floor' => 1, 'lat' => 757, 'lng' => 221],
            ['id' => 10, 'name' => 'Toilet Perempuan', 'floor' => 1, 'lat' => 757, 'lng' => 631],

            // Intersections
            ['id' => 11, 'name' => 'Persimpangan Toilet', 'floor' => 1, 'lat' => 719, 'lng' => 423],
            ['id' => 12, 'name' => 'Persimpangan Toilet Laki-laki', 'floor' => 1, 'lat' => 719, 'lng' => 221],
            ['id' => 13, 'name' => 'Persimpangan Toilet Perempuan', 'floor' => 1, 'lat' => 719, 'lng' => 631],
            ['id' => 22, 'name' => 'Persimpangan Depan Ruangan 103', 'floor' => 1, 'lat' => 413, 'lng' => 126],
            ['id' => 24, 'name' => 'Persimpangan Depan Ruangan 102', 'floor' => 1, 'lat' => 600, 'lng' => 1586],
            ['id' => 25, 'name' => 'Persimpangan Depan Ruangan 101', 'floor' => 1, 'lat' => 510, 'lng' => 1586],

            // Stairs
            ['id' => 14, 'name' => 'Tangga Naik', 'floor' => 1, 'lat' => 554, 'lng' => 1815],

            // Corridors
            ['id' => 15, 'name' => 'Depan Toilet', 'floor' => 1, 'lat' => 612, 'lng' => 423],
            ['id' => 16, 'name' => 'Lorong Kiri-Atas', 'floor' => 1, 'lat' => 612, 'lng' => 126],
            ['id' => 17, 'name' => 'Lorong Kiri-Bawah', 'floor' => 1, 'lat' => 196, 'lng' => 126],
            ['id' => 18, 'name' => 'Lorong Kanan-Bawah', 'floor' => 1, 'lat' => 196, 'lng' => 1681],
            ['id' => 19, 'name' => 'Lorong Kanan-Tengah', 'floor' => 1, 'lat' => 512, 'lng' => 1681],
            ['id' => 20, 'name' => 'Lorong Kanan-Atas', 'floor' => 1, 'lat' => 911, 'lng' => 1586],
            ['id' => 21, 'name' => 'Lorong Tengah-Bawah', 'floor' => 1, 'lat' => 610, 'lng' => 724],
            ['id' => 23, 'name' => 'Lorong Tengah-Atas', 'floor' => 1, 'lat' => 911, 'lng' => 724],


        ];

        DB::table('nodes')->insert($nodes);

        // Create quick lookup array
        $nodeMap = [];

        foreach ($nodes as $node) {
            $nodeMap[$node['id']] = $node;
        }

        // 2. INSERT EDGES (Auto calculate weights)
        $edges = [

            // Lorong
            ['from_node_id' => 16, 'to_node_id' => 15, 'is_stairs' => 0],
            ['from_node_id' => 15, 'to_node_id' => 21, 'is_stairs' => 0],
            ['from_node_id' => 21, 'to_node_id' => 23, 'is_stairs' => 0],
            ['from_node_id' => 23, 'to_node_id' => 3, 'is_stairs' => 0],
            //['from_node_id' => 16, 'to_node_id' => 17, 'is_stairs' => 0],
            ['from_node_id' => 17, 'to_node_id' => 18, 'is_stairs' => 0],
            ['from_node_id' => 18, 'to_node_id' => 19, 'is_stairs' => 0],
            ['from_node_id' => 16, 'to_node_id' => 22, 'is_stairs' => 0],
            ['from_node_id' => 17, 'to_node_id' => 22, 'is_stairs' => 0],
            ['from_node_id' => 20, 'to_node_id' => 23, 'is_stairs' => 0],
            ['from_node_id' => 19, 'to_node_id' => 25, 'is_stairs' => 0],
            ['from_node_id' => 25, 'to_node_id' => 20, 'is_stairs' => 0],

            // Tangga
            ['from_node_id' => 19, 'to_node_id' => 14, 'is_stairs' => 1],
            ['from_node_id' => 4, 'to_node_id' => 16, 'is_stairs' => 1],

            // WC
            ['from_node_id' => 9, 'to_node_id' => 12, 'is_stairs' => 0],
            ['from_node_id' => 12, 'to_node_id' => 11, 'is_stairs' => 0],
            ['from_node_id' => 10, 'to_node_id' => 13, 'is_stairs' => 0],
            ['from_node_id' => 13, 'to_node_id' => 11, 'is_stairs' => 0],
            ['from_node_id' => 11, 'to_node_id' => 15, 'is_stairs' => 0],

            // Pintu
            ['from_node_id' => 1, 'to_node_id' => 18, 'is_stairs' => 0],
            ['from_node_id' => 2, 'to_node_id' => 17, 'is_stairs' => 0],
            ['from_node_id' => 22, 'to_node_id' => 5, 'is_stairs' => 0],
            ['from_node_id' => 20, 'to_node_id' => 8, 'is_stairs' => 0],
            ['from_node_id' => 6, 'to_node_id' => 25, 'is_stairs' => 0],
            ['from_node_id' => 7, 'to_node_id' => 24, 'is_stairs' => 0],



        ];

        $bidirectionalEdges = [];

        foreach ($edges as $edge) {

            $fromNode = $nodeMap[$edge['from_node_id']];
            $toNode = $nodeMap[$edge['to_node_id']];

            // Calculate Euclidean distance
            $weight = sqrt(
                pow($toNode['lat'] - $fromNode['lat'], 2) +
                pow($toNode['lng'] - $fromNode['lng'], 2)
            );

            // Optional rounding
            $weight = round($weight, 2);

            // Forward edge
            $bidirectionalEdges[] = [
                'from_node_id' => $edge['from_node_id'],
                'to_node_id' => $edge['to_node_id'],
                'weight' => $weight,
                'is_stairs' => $edge['is_stairs'],
            ];

            // Reverse edge
            $bidirectionalEdges[] = [
                'from_node_id' => $edge['to_node_id'],
                'to_node_id' => $edge['from_node_id'],
                'weight' => $weight,
                'is_stairs' => $edge['is_stairs'],
            ];
        }

        DB::table('edges')->insert($bidirectionalEdges);
    }
}