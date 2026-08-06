<?php

namespace Database\Seeders\FloorsGraph;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Floor3Seeder extends Seeder
{
    public function run()
    {
        $nodes = [
            // Facilities
            ['id' => 310, 'name' => 'Ruangan 301', 'floor' => 3, 'lat' => 832, 'lng' => 1180],
            ['id' => 311, 'name' => 'Ruangan 302', 'floor' => 3, 'lat' => 832, 'lng' => 1091],
            ['id' => 312, 'name' => 'Ruangan 303', 'floor' => 3, 'lat' => 269, 'lng' => 1180],
            ['id' => 313, 'name' => 'Ruangan 304', 'floor' => 3, 'lat' => 269, 'lng' => 1091],
            ['id' => 314, 'name' => 'Ruangan 305', 'floor' => 3, 'lat' => 269, 'lng' => 539],
            ['id' => 315, 'name' => 'Ruangan 306', 'floor' => 3, 'lat' => 269, 'lng' => 453],
            ['id' => 316, 'name' => 'Teras Baca', 'floor' => 3, 'lat' => 179, 'lng' => 1629],
            ['id' => 317, 'name' => 'Gudang', 'floor' => 3, 'lat' => 911, 'lng' => 1682],

            // Toilets
            ['id' => 320, 'name' => 'Toilet Laki-laki', 'floor' => 3, 'lat' => 757, 'lng' => 221],
            ['id' => 321, 'name' => 'Toilet Perempuan', 'floor' => 3, 'lat' => 757, 'lng' => 631],

            // Intersections
            ['id' => 330, 'name' => 'Persimpangan Toilet', 'floor' => 3, 'lat' => 719, 'lng' => 423],
            ['id' => 331, 'name' => 'Persimpangan Toilet Laki-laki', 'floor' => 3, 'lat' => 719, 'lng' => 221],
            ['id' => 332, 'name' => 'Persimpangan Toilet Perempuan', 'floor' => 3, 'lat' => 719, 'lng' => 631],
            ['id' => 333, 'name' => 'Persimpangan Depan Ruangan 301', 'floor' => 3, 'lat' => 911, 'lng' => 1180],
            ['id' => 334, 'name' => 'Persimpangan Depan Ruangan 302', 'floor' => 3, 'lat' => 911, 'lng' => 1091],
            ['id' => 335, 'name' => 'Persimpangan Depan Ruangan 303', 'floor' => 3, 'lat' => 196, 'lng' => 1180],
            ['id' => 336, 'name' => 'Persimpangan Depan Ruangan 304', 'floor' => 3, 'lat' => 196, 'lng' => 1091],
            ['id' => 337, 'name' => 'Persimpangan Depan Ruangan 305', 'floor' => 3, 'lat' => 196, 'lng' => 539],
            ['id' => 338, 'name' => 'Persimpangan Depan Ruangan 306', 'floor' => 3, 'lat' => 196, 'lng' => 453],
            ['id' => 339, 'name' => 'Persimpangan Depan Tangga Naik', 'floor' => 3, 'lat' => 512, 'lng' => 1815],
            ['id' => 340, 'name' => 'Persimpangan Depan Tangga Turun', 'floor' => 3, 'lat' => 512, 'lng' => 1723],

            // Stairs & Elevator
            ['id' => 341, 'name' => 'Elevator', 'floor' => 3, 'lat' => 759, 'lng' => 126],
            ['id' => 342, 'name' => 'Tangga Naik', 'floor' => 3, 'lat' => 554, 'lng' => 1815],
            ['id' => 343, 'name' => 'Tangga Turun', 'floor' => 3, 'lat' => 554, 'lng' => 1723],

            // Corridors
            ['id' => 350, 'name' => 'Depan Toilet', 'floor' => 3, 'lat' => 612, 'lng' => 423],
            ['id' => 351, 'name' => 'Lorong Kiri-Atas', 'floor' => 3, 'lat' => 612, 'lng' => 126],
            ['id' => 352, 'name' => 'Lorong Kiri-Bawah', 'floor' => 3, 'lat' => 196, 'lng' => 126],
            ['id' => 353, 'name' => 'Lorong Kanan-Bawah', 'floor' => 3, 'lat' => 196, 'lng' => 1549],
            ['id' => 354, 'name' => 'Lorong Kanan-Tengah', 'floor' => 3, 'lat' => 512, 'lng' => 1549],
            ['id' => 355, 'name' => 'Lorong Kanan-Atas', 'floor' => 3, 'lat' => 911, 'lng' => 1549],
            ['id' => 356, 'name' => 'Lorong Tengah-Bawah', 'floor' => 3, 'lat' => 610, 'lng' => 724],
            ['id' => 357, 'name' => 'Lorong Tengah-Atas', 'floor' => 3, 'lat' => 911, 'lng' => 724],
        ];

        DB::table('nodes')->insert($nodes);

        $nodeMap = [];
        foreach ($nodes as $node) {
            $nodeMap[$node['id']] = $node;
        }

        $edges = [
            // Lorong
            ['from_node_id' => 351, 'to_node_id' => 352, 'is_stairs' => 0],
            ['from_node_id' => 350, 'to_node_id' => 351, 'is_stairs' => 0],
            ['from_node_id' => 350, 'to_node_id' => 356, 'is_stairs' => 0],
            ['from_node_id' => 356, 'to_node_id' => 357, 'is_stairs' => 0],
            ['from_node_id' => 334, 'to_node_id' => 357, 'is_stairs' => 0],
            ['from_node_id' => 334, 'to_node_id' => 333, 'is_stairs' => 0],
            ['from_node_id' => 355, 'to_node_id' => 333, 'is_stairs' => 0], //Test 3 di comment atau dipotong
            ['from_node_id' => 352, 'to_node_id' => 338, 'is_stairs' => 0],
            ['from_node_id' => 338, 'to_node_id' => 337, 'is_stairs' => 0],
            ['from_node_id' => 337, 'to_node_id' => 336, 'is_stairs' => 0],
            ['from_node_id' => 335, 'to_node_id' => 336, 'is_stairs' => 0],
            ['from_node_id' => 335, 'to_node_id' => 353, 'is_stairs' => 0], //Test 3 di comment atau dipotong
            ['from_node_id' => 352, 'to_node_id' => 338, 'is_stairs' => 0],
            ['from_node_id' => 354, 'to_node_id' => 353, 'is_stairs' => 0],
            ['from_node_id' => 355, 'to_node_id' => 354, 'is_stairs' => 0],
            ['from_node_id' => 342, 'to_node_id' => 339, 'is_stairs' => 0],
            ['from_node_id' => 340, 'to_node_id' => 339, 'is_stairs' => 0],
            ['from_node_id' => 340, 'to_node_id' => 343, 'is_stairs' => 0],
            ['from_node_id' => 340, 'to_node_id' => 354, 'is_stairs' => 0],

            // Elevator
            ['from_node_id' => 351, 'to_node_id' => 341, 'is_stairs' => 0],

            // WC & Ruangan
            ['from_node_id' => 350, 'to_node_id' => 330, 'is_stairs' => 0],
            ['from_node_id' => 332, 'to_node_id' => 330, 'is_stairs' => 0],
            ['from_node_id' => 331, 'to_node_id' => 330, 'is_stairs' => 0],
            ['from_node_id' => 331, 'to_node_id' => 320, 'is_stairs' => 0],
            ['from_node_id' => 332, 'to_node_id' => 321, 'is_stairs' => 0],
            ['from_node_id' => 317, 'to_node_id' => 355, 'is_stairs' => 0],
            ['from_node_id' => 310, 'to_node_id' => 333, 'is_stairs' => 0],
            ['from_node_id' => 334, 'to_node_id' => 311, 'is_stairs' => 0],
            ['from_node_id' => 316, 'to_node_id' => 353, 'is_stairs' => 0],
            ['from_node_id' => 312, 'to_node_id' => 335, 'is_stairs' => 0],
            ['from_node_id' => 313, 'to_node_id' => 336, 'is_stairs' => 0],
            ['from_node_id' => 314, 'to_node_id' => 337, 'is_stairs' => 0],
            ['from_node_id' => 315, 'to_node_id' => 338, 'is_stairs' => 0],


            // Floors 2-3 //
            ['from_node_id' => 241, 'to_node_id' => 341, 'is_stairs' => 1, 'weight' => 1], //Elevator
            ['from_node_id' => 242, 'to_node_id' => 343, 'is_stairs' => 1, 'weight' => 10], //Tangga

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