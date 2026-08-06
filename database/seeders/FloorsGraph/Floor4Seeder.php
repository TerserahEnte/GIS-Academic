<?php

namespace Database\Seeders\FloorsGraph;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Floor4Seeder extends Seeder
{
    public function run()
    {
        $nodes = [
            // Facilities
            ['id' => 410, 'name' => 'Ruangan 401', 'floor' => 4, 'lat' => 832, 'lng' => 1180],
            ['id' => 411, 'name' => 'Ruangan 402', 'floor' => 4, 'lat' => 832, 'lng' => 1091],
            ['id' => 412, 'name' => 'Ruangan 403', 'floor' => 4, 'lat' => 269, 'lng' => 1180],
            ['id' => 413, 'name' => 'Ruangan 404', 'floor' => 4, 'lat' => 269, 'lng' => 1091],
            ['id' => 414, 'name' => 'Ruangan 405', 'floor' => 4, 'lat' => 269, 'lng' => 539],
            ['id' => 415, 'name' => 'Ruangan 406', 'floor' => 4, 'lat' => 269, 'lng' => 453],
            ['id' => 416, 'name' => 'Teras Baca', 'floor' => 4, 'lat' => 179, 'lng' => 1629],
            ['id' => 417, 'name' => 'Gudang', 'floor' => 4, 'lat' => 911, 'lng' => 1682],

            // Toilets
            ['id' => 420, 'name' => 'Toilet Laki-laki', 'floor' => 4, 'lat' => 757, 'lng' => 221],
            ['id' => 421, 'name' => 'Toilet Perempuan', 'floor' => 4, 'lat' => 757, 'lng' => 631],

            // Intersections
            ['id' => 430, 'name' => 'Persimpangan Toilet', 'floor' => 4, 'lat' => 719, 'lng' => 423],
            ['id' => 431, 'name' => 'Persimpangan Toilet Laki-laki', 'floor' => 4, 'lat' => 719, 'lng' => 221],
            ['id' => 432, 'name' => 'Persimpangan Toilet Perempuan', 'floor' => 4, 'lat' => 719, 'lng' => 631],
            ['id' => 433, 'name' => 'Persimpangan Depan Ruangan 401', 'floor' => 4, 'lat' => 911, 'lng' => 1180],
            ['id' => 434, 'name' => 'Persimpangan Depan Ruangan 402', 'floor' => 4, 'lat' => 911, 'lng' => 1091],
            ['id' => 435, 'name' => 'Persimpangan Depan Ruangan 403', 'floor' => 4, 'lat' => 196, 'lng' => 1180],
            ['id' => 436, 'name' => 'Persimpangan Depan Ruangan 404', 'floor' => 4, 'lat' => 196, 'lng' => 1091],
            ['id' => 437, 'name' => 'Persimpangan Depan Ruangan 405', 'floor' => 4, 'lat' => 196, 'lng' => 539],
            ['id' => 438, 'name' => 'Persimpangan Depan Ruangan 406', 'floor' => 4, 'lat' => 196, 'lng' => 453],
            ['id' => 439, 'name' => 'Persimpangan Depan Tangga Naik', 'floor' => 4, 'lat' => 512, 'lng' => 1815],
            ['id' => 440, 'name' => 'Persimpangan Depan Tangga Turun', 'floor' => 4, 'lat' => 512, 'lng' => 1723],

            // Stairs & Elevator
            ['id' => 441, 'name' => 'Elevator', 'floor' => 4, 'lat' => 759, 'lng' => 126],
            ['id' => 442, 'name' => 'Tangga Naik', 'floor' => 4, 'lat' => 554, 'lng' => 1815],
            ['id' => 443, 'name' => 'Tangga Turun', 'floor' => 4, 'lat' => 554, 'lng' => 1723],

            // Corridors
            ['id' => 450, 'name' => 'Depan Toilet', 'floor' => 4, 'lat' => 612, 'lng' => 423],
            ['id' => 451, 'name' => 'Lorong Kiri-Atas', 'floor' => 4, 'lat' => 612, 'lng' => 126],
            ['id' => 452, 'name' => 'Lorong Kiri-Bawah', 'floor' => 4, 'lat' => 196, 'lng' => 126],
            ['id' => 453, 'name' => 'Lorong Kanan-Bawah', 'floor' => 4, 'lat' => 196, 'lng' => 1549],
            ['id' => 454, 'name' => 'Lorong Kanan-Tengah', 'floor' => 4, 'lat' => 512, 'lng' => 1549],
            ['id' => 455, 'name' => 'Lorong Kanan-Atas', 'floor' => 4, 'lat' => 911, 'lng' => 1549],
            ['id' => 456, 'name' => 'Lorong Tengah-Bawah', 'floor' => 4, 'lat' => 610, 'lng' => 724],
            ['id' => 457, 'name' => 'Lorong Tengah-Atas', 'floor' => 4, 'lat' => 911, 'lng' => 724],
        ];

        DB::table('nodes')->insert($nodes);

        $nodeMap = [];
        foreach ($nodes as $node) {
            $nodeMap[$node['id']] = $node;
        }

        $edges = [
            // Lorong
            ['from_node_id' => 451, 'to_node_id' => 452, 'is_stairs' => 0],
            ['from_node_id' => 450, 'to_node_id' => 451, 'is_stairs' => 0],
            ['from_node_id' => 450, 'to_node_id' => 456, 'is_stairs' => 0],
            ['from_node_id' => 456, 'to_node_id' => 457, 'is_stairs' => 0],
            ['from_node_id' => 434, 'to_node_id' => 457, 'is_stairs' => 0],
            ['from_node_id' => 434, 'to_node_id' => 433, 'is_stairs' => 0],
            ['from_node_id' => 455, 'to_node_id' => 433, 'is_stairs' => 0],
            ['from_node_id' => 452, 'to_node_id' => 438, 'is_stairs' => 0],
            ['from_node_id' => 438, 'to_node_id' => 437, 'is_stairs' => 0],
            ['from_node_id' => 437, 'to_node_id' => 436, 'is_stairs' => 0],
            ['from_node_id' => 435, 'to_node_id' => 436, 'is_stairs' => 0],
            ['from_node_id' => 435, 'to_node_id' => 453, 'is_stairs' => 0],
            ['from_node_id' => 454, 'to_node_id' => 453, 'is_stairs' => 0],
            ['from_node_id' => 455, 'to_node_id' => 454, 'is_stairs' => 0],
            ['from_node_id' => 442, 'to_node_id' => 439, 'is_stairs' => 0],
            ['from_node_id' => 440, 'to_node_id' => 439, 'is_stairs' => 0],
            ['from_node_id' => 440, 'to_node_id' => 443, 'is_stairs' => 0],
            ['from_node_id' => 440, 'to_node_id' => 454, 'is_stairs' => 0],

            // Elevator
            ['from_node_id' => 451, 'to_node_id' => 441, 'is_stairs' => 0],

            // WC & Ruangan
            ['from_node_id' => 450, 'to_node_id' => 430, 'is_stairs' => 0],
            ['from_node_id' => 432, 'to_node_id' => 430, 'is_stairs' => 0],
            ['from_node_id' => 431, 'to_node_id' => 430, 'is_stairs' => 0],
            ['from_node_id' => 431, 'to_node_id' => 420, 'is_stairs' => 0],
            ['from_node_id' => 432, 'to_node_id' => 421, 'is_stairs' => 0],
            ['from_node_id' => 417, 'to_node_id' => 455, 'is_stairs' => 0],
            ['from_node_id' => 410, 'to_node_id' => 433, 'is_stairs' => 0],
            ['from_node_id' => 434, 'to_node_id' => 411, 'is_stairs' => 0],
            ['from_node_id' => 416, 'to_node_id' => 453, 'is_stairs' => 0],
            ['from_node_id' => 412, 'to_node_id' => 435, 'is_stairs' => 0],
            ['from_node_id' => 413, 'to_node_id' => 436, 'is_stairs' => 0],
            ['from_node_id' => 414, 'to_node_id' => 437, 'is_stairs' => 0],
            ['from_node_id' => 415, 'to_node_id' => 438, 'is_stairs' => 0],

            // Floors 3-4 //
            ['from_node_id' => 341, 'to_node_id' => 441, 'is_stairs' => 1, 'weight' => 1], // Elevator
            ['from_node_id' => 342, 'to_node_id' => 443, 'is_stairs' => 1, 'weight' => 10], //Tangga
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
