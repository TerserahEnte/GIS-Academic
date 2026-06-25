<?php

namespace Database\Seeders\FloorsGraph;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Floor1Seeder extends Seeder
{
    public function run()
    {
        $nodes = [
            // Entrances
            ['id' => 101, 'name' => 'Pintu Utama', 'floor' => 1, 'lat' => 138, 'lng' => 1681],
            ['id' => 102, 'name' => 'Pintu Barat', 'floor' => 1, 'lat' => 196, 'lng' => 52],
            ['id' => 103, 'name' => 'Pintu Utara', 'floor' => 1, 'lat' => 954, 'lng' => 724],

            // Facilities
            ['id' => 110, 'name' => 'Ruangan 103', 'floor' => 1, 'lat' => 413, 'lng' => 196],
            ['id' => 111, 'name' => 'Ruangan 102', 'floor' => 1, 'lat' => 512, 'lng' => 1477],
            ['id' => 112, 'name' => 'Ruangan 101', 'floor' => 1, 'lat' => 600, 'lng' => 1477],
            ['id' => 113, 'name' => 'Gudang', 'floor' => 1, 'lat' => 911, 'lng' => 1682],

            // Toilets
            ['id' => 120, 'name' => 'Toilet Laki-laki', 'floor' => 1, 'lat' => 757, 'lng' => 221],
            ['id' => 121, 'name' => 'Toilet Perempuan', 'floor' => 1, 'lat' => 757, 'lng' => 631],

            // Intersections
            ['id' => 130, 'name' => 'Persimpangan Toilet', 'floor' => 1, 'lat' => 719, 'lng' => 423],
            ['id' => 131, 'name' => 'Persimpangan Toilet Laki-laki', 'floor' => 1, 'lat' => 719, 'lng' => 221],
            ['id' => 132, 'name' => 'Persimpangan Toilet Perempuan', 'floor' => 1, 'lat' => 719, 'lng' => 631],
            ['id' => 133, 'name' => 'Persimpangan Depan Ruangan 103', 'floor' => 1, 'lat' => 413, 'lng' => 126],
            ['id' => 134, 'name' => 'Persimpangan Depan Ruangan 102', 'floor' => 1, 'lat' => 600, 'lng' => 1586],
            ['id' => 135, 'name' => 'Persimpangan Depan Ruangan 101', 'floor' => 1, 'lat' => 510, 'lng' => 1586],

            // Stairs
            ['id' => 140, 'name' => 'Tangga Naik', 'floor' => 1, 'lat' => 554, 'lng' => 1815],
            ['id' => 141, 'name' => 'Elevator', 'floor' => 1, 'lat' => 759, 'lng' => 126],

            // Corridors
            ['id' => 150, 'name' => 'Depan Toilet', 'floor' => 1, 'lat' => 612, 'lng' => 423],
            ['id' => 151, 'name' => 'Lorong Kiri-Atas', 'floor' => 1, 'lat' => 612, 'lng' => 126],
            ['id' => 152, 'name' => 'Lorong Kiri-Bawah', 'floor' => 1, 'lat' => 196, 'lng' => 126],
            ['id' => 153, 'name' => 'Lorong Kanan-Bawah', 'floor' => 1, 'lat' => 196, 'lng' => 1681],
            ['id' => 154, 'name' => 'Lorong Kanan-Tengah', 'floor' => 1, 'lat' => 512, 'lng' => 1681],
            ['id' => 155, 'name' => 'Lorong Kanan-Atas', 'floor' => 1, 'lat' => 911, 'lng' => 1586],
            ['id' => 156, 'name' => 'Lorong Tengah-Bawah', 'floor' => 1, 'lat' => 610, 'lng' => 724],
            ['id' => 157, 'name' => 'Lorong Tengah-Atas', 'floor' => 1, 'lat' => 911, 'lng' => 724],
        ];

        DB::table('nodes')->insert($nodes);

        $nodeMap = [];
        foreach ($nodes as $node) {
            $nodeMap[$node['id']] = $node;
        }

        $edges = [
            // Lorong
            ['from_node_id' => 151, 'to_node_id' => 150, 'is_stairs' => 0],
            ['from_node_id' => 150, 'to_node_id' => 156, 'is_stairs' => 0],
            ['from_node_id' => 156, 'to_node_id' => 157, 'is_stairs' => 0],
            ['from_node_id' => 157, 'to_node_id' => 103, 'is_stairs' => 0],
            ['from_node_id' => 152, 'to_node_id' => 153, 'is_stairs' => 0],
            ['from_node_id' => 153, 'to_node_id' => 154, 'is_stairs' => 0],
            ['from_node_id' => 151, 'to_node_id' => 133, 'is_stairs' => 0],
            ['from_node_id' => 152, 'to_node_id' => 133, 'is_stairs' => 0],
            ['from_node_id' => 155, 'to_node_id' => 157, 'is_stairs' => 0],
            ['from_node_id' => 154, 'to_node_id' => 135, 'is_stairs' => 0],
            ['from_node_id' => 135, 'to_node_id' => 155, 'is_stairs' => 0],

            // Tangga & Elevator
            ['from_node_id' => 154, 'to_node_id' => 140, 'is_stairs' => 0],
            ['from_node_id' => 141, 'to_node_id' => 151, 'is_stairs' => 0],

            // WC
            ['from_node_id' => 120, 'to_node_id' => 131, 'is_stairs' => 0],
            ['from_node_id' => 131, 'to_node_id' => 130, 'is_stairs' => 0],
            ['from_node_id' => 121, 'to_node_id' => 132, 'is_stairs' => 0],
            ['from_node_id' => 132, 'to_node_id' => 130, 'is_stairs' => 0],
            ['from_node_id' => 130, 'to_node_id' => 150, 'is_stairs' => 0],

            // Pintu & Ruangan
            ['from_node_id' => 101, 'to_node_id' => 153, 'is_stairs' => 0],
            ['from_node_id' => 102, 'to_node_id' => 152, 'is_stairs' => 0],
            ['from_node_id' => 133, 'to_node_id' => 110, 'is_stairs' => 0],
            ['from_node_id' => 155, 'to_node_id' => 113, 'is_stairs' => 0],
            ['from_node_id' => 111, 'to_node_id' => 135, 'is_stairs' => 0],
            ['from_node_id' => 112, 'to_node_id' => 134, 'is_stairs' => 0],


        ];

        $bidirectionalEdges = [];
        foreach ($edges as $edge) {
            if (isset($edge['weight'])) {
                $weight = $edge['weight'];
            } else {
                $fromNode = $nodeMap[$edge['from_node_id']];
                $toNode = $nodeMap[$edge['to_node_id']];
                $weight = round(sqrt(pow($toNode['lat'] - $fromNode['lat'], 2) + pow($toNode['lng'] - $fromNode['lng'], 2)), 2);
            }

            $bidirectionalEdges[] = [
                'from_node_id' => $edge['from_node_id'], 'to_node_id' => $edge['to_node_id'],
                'weight' => $weight, 'is_stairs' => $edge['is_stairs'],
            ];
            $bidirectionalEdges[] = [
                'from_node_id' => $edge['to_node_id'], 'to_node_id' => $edge['from_node_id'],
                'weight' => $weight, 'is_stairs' => $edge['is_stairs'],
            ];
        }

        DB::table('edges')->insert($bidirectionalEdges);
    }
}