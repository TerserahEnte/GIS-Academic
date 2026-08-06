<?php

namespace Database\Seeders\FloorsGraph;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Floor5Seeder extends Seeder
{
    public function run()
    {
        $nodes = [
            // Facilities
            ['id' => 510, 'name' => 'Aula Kesenian-Kanan', 'floor' => 5, 'lat' => 548, 'lng' => 1491],
            ['id' => 511, 'name' => 'Aula Kesenian-Kiri', 'floor' => 5, 'lat' => 548, 'lng' => 782],
            ['id' => 512, 'name' => 'Ruangan 501', 'floor' => 5, 'lat' => 397, 'lng' => 399],
            ['id' => 513, 'name' => 'Ruangan 502', 'floor' => 5, 'lat' => 397, 'lng' => 311],
            // ['id' => 514, 'name' => 'Ruangan 405', 'floor' => 5, 'lat' => 269, 'lng' => 539],
            // ['id' => 515, 'name' => 'Ruangan 406', 'floor' => 5, 'lat' => 269, 'lng' => 453],
            ['id' => 516, 'name' => 'Teras Baca', 'floor' => 5, 'lat' => 179, 'lng' => 1629],
            ['id' => 517, 'name' => 'Gudang', 'floor' => 5, 'lat' => 911, 'lng' => 1682],

            // Toilets
            ['id' => 520, 'name' => 'Toilet Laki-laki', 'floor' => 5, 'lat' => 757, 'lng' => 221],
            ['id' => 521, 'name' => 'Toilet Perempuan', 'floor' => 5, 'lat' => 757, 'lng' => 631],

            // Intersections
            ['id' => 530, 'name' => 'Persimpangan Toilet', 'floor' => 5, 'lat' => 719, 'lng' => 423],
            ['id' => 531, 'name' => 'Persimpangan Toilet Laki-laki', 'floor' => 5, 'lat' => 719, 'lng' => 221],
            ['id' => 532, 'name' => 'Persimpangan Toilet Perempuan', 'floor' => 5, 'lat' => 719, 'lng' => 631],
            ['id' => 533, 'name' => 'Persimpangan Depan Ruangan 501', 'floor' => 5, 'lat' => 548, 'lng' => 399],
            ['id' => 534, 'name' => 'Persimpangan Depan Ruangan 502', 'floor' => 5, 'lat' => 548, 'lng' => 311],
            // ['id' => 535, 'name' => 'Persimpangan Depan Ruangan 403', 'floor' => 5, 'lat' => 196, 'lng' => 1180],
            // ['id' => 536, 'name' => 'Persimpangan Depan Ruangan 404', 'floor' => 5, 'lat' => 196, 'lng' => 1091],
            // ['id' => 537, 'name' => 'Persimpangan Depan Ruangan 405', 'floor' => 5, 'lat' => 196, 'lng' => 539],
            ['id' => 538, 'name' => 'Persimpangan Depan Aula Kesenian-Kanan', 'floor' => 5, 'lat' => 548, 'lng' => 1549],
            ['id' => 539, 'name' => 'Persimpangan Depan Tangga Naik', 'floor' => 5, 'lat' => 512, 'lng' => 1815],
            ['id' => 540, 'name' => 'Persimpangan Depan Tangga Turun', 'floor' => 5, 'lat' => 512, 'lng' => 1723],

            // Stairs & Elevator
            ['id' => 541, 'name' => 'Elevator', 'floor' => 5, 'lat' => 759, 'lng' => 126],
            ['id' => 542, 'name' => 'Tangga Naik', 'floor' => 5, 'lat' => 554, 'lng' => 1815],
            ['id' => 543, 'name' => 'Tangga Turun', 'floor' => 5, 'lat' => 554, 'lng' => 1723],

            // Corridors
            ['id' => 550, 'name' => 'Depan Toilet', 'floor' => 5, 'lat' => 548, 'lng' => 423],
            ['id' => 551, 'name' => 'Lorong Kiri-Tengah', 'floor' => 5, 'lat' => 548, 'lng' => 126],
            // ['id' => 552, 'name' => 'Lorong Kiri-Bawah', 'floor' => 5, 'lat' => 196, 'lng' => 126],
            ['id' => 553, 'name' => 'Lorong Kanan-Bawah', 'floor' => 5, 'lat' => 196, 'lng' => 1549],
            ['id' => 554, 'name' => 'Lorong Kanan-Tengah', 'floor' => 5, 'lat' => 512, 'lng' => 1549],
            ['id' => 555, 'name' => 'Lorong Kanan-Atas', 'floor' => 5, 'lat' => 911, 'lng' => 1549],
            ['id' => 556, 'name' => 'Lorong Tengah-Bawah', 'floor' => 5, 'lat' => 548, 'lng' => 724],
            ['id' => 557, 'name' => 'Lorong Tengah-Atas', 'floor' => 5, 'lat' => 911, 'lng' => 724],
            ['id' => 558, 'name' => 'Lorong Tengah-Tengah', 'floor' => 5, 'lat' => 196, 'lng' => 724],
        ];

        DB::table('nodes')->insert($nodes);

        $nodeMap = [];
        foreach ($nodes as $node) {
            $nodeMap[$node['id']] = $node;
        }

        $edges = [
            // Lorong
            // ['from_node_id' => 551, 'to_node_id' => 552, 'is_stairs' => 0],
            // ['from_node_id' => 550, 'to_node_id' => 551, 'is_stairs' => 0],
            ['from_node_id' => 551, 'to_node_id' => 534, 'is_stairs' => 0],
            ['from_node_id' => 533, 'to_node_id' => 534, 'is_stairs' => 0],
            ['from_node_id' => 533, 'to_node_id' => 550, 'is_stairs' => 0],
            ['from_node_id' => 550, 'to_node_id' => 556, 'is_stairs' => 0],
            ['from_node_id' => 556, 'to_node_id' => 557, 'is_stairs' => 0],
            ['from_node_id' => 555, 'to_node_id' => 557, 'is_stairs' => 0],
            // ['from_node_id' => 534, 'to_node_id' => 557, 'is_stairs' => 0],
            // ['from_node_id' => 534, 'to_node_id' => 533, 'is_stairs' => 0],
            // ['from_node_id' => 555, 'to_node_id' => 533, 'is_stairs' => 0],
            // ['from_node_id' => 552, 'to_node_id' => 538, 'is_stairs' => 0],
            // ['from_node_id' => 538, 'to_node_id' => 537, 'is_stairs' => 0],
            // ['from_node_id' => 537, 'to_node_id' => 536, 'is_stairs' => 0],
            // ['from_node_id' => 535, 'to_node_id' => 536, 'is_stairs' => 0],
            // ['from_node_id' => 535, 'to_node_id' => 553, 'is_stairs' => 0],
            ['from_node_id' => 554, 'to_node_id' => 538, 'is_stairs' => 0],
            ['from_node_id' => 554, 'to_node_id' => 553, 'is_stairs' => 0],
            ['from_node_id' => 555, 'to_node_id' => 554, 'is_stairs' => 0],
            ['from_node_id' => 542, 'to_node_id' => 539, 'is_stairs' => 0],
            ['from_node_id' => 540, 'to_node_id' => 539, 'is_stairs' => 0],
            ['from_node_id' => 540, 'to_node_id' => 543, 'is_stairs' => 0],
            ['from_node_id' => 540, 'to_node_id' => 554, 'is_stairs' => 0],
            ['from_node_id' => 558, 'to_node_id' => 556, 'is_stairs' => 0],
            ['from_node_id' => 558, 'to_node_id' => 553, 'is_stairs' => 0],

            // Elevator
            ['from_node_id' => 551, 'to_node_id' => 541, 'is_stairs' => 0],

            // WC & Ruangan
            ['from_node_id' => 550, 'to_node_id' => 530, 'is_stairs' => 0],
            ['from_node_id' => 532, 'to_node_id' => 530, 'is_stairs' => 0],
            ['from_node_id' => 531, 'to_node_id' => 530, 'is_stairs' => 0],
            ['from_node_id' => 531, 'to_node_id' => 520, 'is_stairs' => 0],
            ['from_node_id' => 532, 'to_node_id' => 521, 'is_stairs' => 0],
            ['from_node_id' => 517, 'to_node_id' => 555, 'is_stairs' => 0],
            // ['from_node_id' => 510, 'to_node_id' => 533, 'is_stairs' => 0],
            // ['from_node_id' => 534, 'to_node_id' => 511, 'is_stairs' => 0],
            ['from_node_id' => 516, 'to_node_id' => 553, 'is_stairs' => 0],
            ['from_node_id' => 512, 'to_node_id' => 533, 'is_stairs' => 0],
            ['from_node_id' => 513, 'to_node_id' => 534, 'is_stairs' => 0],
            ['from_node_id' => 556, 'to_node_id' => 511, 'is_stairs' => 0],
            ['from_node_id' => 538, 'to_node_id' => 510, 'is_stairs' => 0],
            // ['from_node_id' => 512, 'to_node_id' => 535, 'is_stairs' => 0],
            // ['from_node_id' => 513, 'to_node_id' => 536, 'is_stairs' => 0],
            // ['from_node_id' => 514, 'to_node_id' => 537, 'is_stairs' => 0],
            // ['from_node_id' => 515, 'to_node_id' => 538, 'is_stairs' => 0],

            // Floors 4-5 //
            ['from_node_id' => 441, 'to_node_id' => 541, 'is_stairs' => 1, 'weight' => 1], //Elevator
            ['from_node_id' => 442, 'to_node_id' => 543, 'is_stairs' => 1, 'weight' => 10], //Tangga
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