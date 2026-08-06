<?php

namespace Database\Seeders\FloorsGraph;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Floor2Seeder extends Seeder
{
    public function run()
    {
        $nodes = [
            // Facilities
            ['id' => 210, 'name' => 'Ruangan 201', 'floor' => 2, 'lat' => 832, 'lng' => 1180],
            ['id' => 211, 'name' => 'Ruangan 202', 'floor' => 2, 'lat' => 832, 'lng' => 1091],
            ['id' => 212, 'name' => 'Ruangan 203', 'floor' => 2, 'lat' => 269, 'lng' => 1180],
            ['id' => 213, 'name' => 'Ruangan 204', 'floor' => 2, 'lat' => 269, 'lng' => 1091],
            ['id' => 214, 'name' => 'Ruangan 205', 'floor' => 2, 'lat' => 269, 'lng' => 539],
            ['id' => 215, 'name' => 'Ruangan 206', 'floor' => 2, 'lat' => 269, 'lng' => 453],
            ['id' => 216, 'name' => 'Teras Baca', 'floor' => 2, 'lat' => 179, 'lng' => 1629],
            ['id' => 217, 'name' => 'Gudang', 'floor' => 2, 'lat' => 911, 'lng' => 1682],

            // Toilets
            ['id' => 220, 'name' => 'Toilet Laki-laki', 'floor' => 2, 'lat' => 757, 'lng' => 221],
            ['id' => 221, 'name' => 'Toilet Perempuan', 'floor' => 2, 'lat' => 757, 'lng' => 631],

            // Intersections
            ['id' => 230, 'name' => 'Persimpangan Toilet', 'floor' => 2, 'lat' => 719, 'lng' => 423],
            ['id' => 231, 'name' => 'Persimpangan Toilet Laki-laki', 'floor' => 2, 'lat' => 719, 'lng' => 221],
            ['id' => 232, 'name' => 'Persimpangan Toilet Perempuan', 'floor' => 2, 'lat' => 719, 'lng' => 631],
            ['id' => 233, 'name' => 'Persimpangan Depan Ruangan 201', 'floor' => 2, 'lat' => 911, 'lng' => 1180],
            ['id' => 234, 'name' => 'Persimpangan Depan Ruangan 202', 'floor' => 2, 'lat' => 911, 'lng' => 1091],
            ['id' => 235, 'name' => 'Persimpangan Depan Ruangan 203', 'floor' => 2, 'lat' => 196, 'lng' => 1180],
            ['id' => 236, 'name' => 'Persimpangan Depan Ruangan 204', 'floor' => 2, 'lat' => 196, 'lng' => 1091],
            ['id' => 237, 'name' => 'Persimpangan Depan Ruangan 205', 'floor' => 2, 'lat' => 196, 'lng' => 539],
            ['id' => 238, 'name' => 'Persimpangan Depan Ruangan 206', 'floor' => 2, 'lat' => 196, 'lng' => 453],
            ['id' => 239, 'name' => 'Persimpangan Depan Tangga Naik', 'floor' => 2, 'lat' => 512, 'lng' => 1815],
            ['id' => 240, 'name' => 'Persimpangan Depan Tangga Turun', 'floor' => 2, 'lat' => 512, 'lng' => 1723],

            // Stairs
            ['id' => 241, 'name' => 'Elevator', 'floor' => 2, 'lat' => 759, 'lng' => 126],
            ['id' => 242, 'name' => 'Tangga Naik', 'floor' => 2, 'lat' => 554, 'lng' => 1815],
            ['id' => 243, 'name' => 'Tangga Turun', 'floor' => 2, 'lat' => 554, 'lng' => 1723],

            // Corridors
            ['id' => 250, 'name' => 'Depan Toilet', 'floor' => 2, 'lat' => 612, 'lng' => 423],
            ['id' => 251, 'name' => 'Lorong Kiri-Atas', 'floor' => 2, 'lat' => 612, 'lng' => 126],
            ['id' => 252, 'name' => 'Lorong Kiri-Bawah', 'floor' => 2, 'lat' => 196, 'lng' => 126],
            ['id' => 253, 'name' => 'Lorong Kanan-Bawah', 'floor' => 2, 'lat' => 196, 'lng' => 1549],
            ['id' => 254, 'name' => 'Lorong Kanan-Tengah', 'floor' => 2, 'lat' => 512, 'lng' => 1549],
            ['id' => 255, 'name' => 'Lorong Kanan-Atas', 'floor' => 2, 'lat' => 911, 'lng' => 1549],
            ['id' => 256, 'name' => 'Lorong Tengah-Bawah', 'floor' => 2, 'lat' => 610, 'lng' => 724],
            ['id' => 257, 'name' => 'Lorong Tengah-Atas', 'floor' => 2, 'lat' => 911, 'lng' => 724],
        ];

        DB::table('nodes')->insert($nodes);

        $nodeMap = [];
        foreach ($nodes as $node) {
            $nodeMap[$node['id']] = $node;
        }

        $edges = [
            // Lorong
            ['from_node_id' => 251, 'to_node_id' => 252, 'is_stairs' => 0],
            ['from_node_id' => 250, 'to_node_id' => 251, 'is_stairs' => 0],
            ['from_node_id' => 250, 'to_node_id' => 256, 'is_stairs' => 0],
            ['from_node_id' => 256, 'to_node_id' => 257, 'is_stairs' => 0],
            ['from_node_id' => 234, 'to_node_id' => 257, 'is_stairs' => 0],
            ['from_node_id' => 234, 'to_node_id' => 233, 'is_stairs' => 0],
            ['from_node_id' => 255, 'to_node_id' => 233, 'is_stairs' => 0],
            ['from_node_id' => 252, 'to_node_id' => 238, 'is_stairs' => 0],
            ['from_node_id' => 238, 'to_node_id' => 237, 'is_stairs' => 0],
            ['from_node_id' => 237, 'to_node_id' => 236, 'is_stairs' => 0],
            ['from_node_id' => 235, 'to_node_id' => 236, 'is_stairs' => 0],
            ['from_node_id' => 235, 'to_node_id' => 253, 'is_stairs' => 0],
            ['from_node_id' => 254, 'to_node_id' => 253, 'is_stairs' => 0],
            ['from_node_id' => 255, 'to_node_id' => 254, 'is_stairs' => 0],
            ['from_node_id' => 242, 'to_node_id' => 239, 'is_stairs' => 0],
            ['from_node_id' => 240, 'to_node_id' => 239, 'is_stairs' => 0],
            ['from_node_id' => 240, 'to_node_id' => 243, 'is_stairs' => 0],
            ['from_node_id' => 240, 'to_node_id' => 254, 'is_stairs' => 0],

            // Elevator
            ['from_node_id' => 251, 'to_node_id' => 241, 'is_stairs' => 0],

            // WC & Ruangan
            ['from_node_id' => 250, 'to_node_id' => 230, 'is_stairs' => 0],
            ['from_node_id' => 232, 'to_node_id' => 230, 'is_stairs' => 0],
            ['from_node_id' => 231, 'to_node_id' => 230, 'is_stairs' => 0],
            ['from_node_id' => 231, 'to_node_id' => 220, 'is_stairs' => 0],
            ['from_node_id' => 232, 'to_node_id' => 221, 'is_stairs' => 0],
            ['from_node_id' => 217, 'to_node_id' => 255, 'is_stairs' => 0],
            ['from_node_id' => 210, 'to_node_id' => 233, 'is_stairs' => 0],
            ['from_node_id' => 234, 'to_node_id' => 211, 'is_stairs' => 0],
            ['from_node_id' => 216, 'to_node_id' => 253, 'is_stairs' => 0],
            ['from_node_id' => 212, 'to_node_id' => 235, 'is_stairs' => 0],
            ['from_node_id' => 213, 'to_node_id' => 236, 'is_stairs' => 0],
            ['from_node_id' => 214, 'to_node_id' => 237, 'is_stairs' => 0],
            ['from_node_id' => 215, 'to_node_id' => 238, 'is_stairs' => 0],

            // Floors 1-2 //
            ['from_node_id' => 141, 'to_node_id' => 241, 'is_stairs' => 1, 'weight' => 1], //Elevator
            ['from_node_id' => 140, 'to_node_id' => 243, 'is_stairs' => 1, 'weight' => 10], //Tangga

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