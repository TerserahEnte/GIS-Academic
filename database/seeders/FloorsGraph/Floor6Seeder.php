<?php

namespace Database\Seeders\FloorsGraph;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Floor6Seeder extends Seeder
{
    public function run()
    {
        $nodes = [
        // Facilities
        ['id' => 610, 'name' => 'Ruangan 601', 'floor' => 6, 'lat' => 615, 'lng' => 1248],
        ['id' => 611, 'name' => 'Ruangan 602', 'floor' => 6, 'lat' => 615, 'lng' => 1077],
        ['id' => 612, 'name' => 'Ruangan 603', 'floor' => 6, 'lat' => 531, 'lng' => 1248],
        ['id' => 613, 'name' => 'Ruangan 604', 'floor' => 6, 'lat' => 531, 'lng' => 1077],
        ['id' => 614, 'name' => 'Laboratorium 605', 'floor' => 6, 'lat' => 252, 'lng' => 238],
        // ['id' => 615, 'name' => 'Ruangan 606', 'floor' => 6, 'lat' => 269, 'lng' => 453],
        // ['id' => 616, 'name' => 'Teras Baca', 'floor' => 6, 'lat' => 179, 'lng' => 1629],
        ['id' => 617, 'name' => 'Gudang', 'floor' => 6, 'lat' => 911, 'lng' => 1682],

        // Toilets
        ['id' => 620, 'name' => 'Toilet Laki-laki', 'floor' => 6, 'lat' => 757, 'lng' => 235],
        ['id' => 621, 'name' => 'Toilet Perempuan', 'floor' => 6, 'lat' => 757, 'lng' => 631],

        // Intersections
        ['id' => 630, 'name' => 'Persimpangan Toilet', 'floor' => 6, 'lat' => 719, 'lng' => 436],
        ['id' => 631, 'name' => 'Persimpangan Toilet Laki-laki', 'floor' => 6, 'lat' => 719, 'lng' => 235],
        ['id' => 632, 'name' => 'Persimpangan Toilet Perempuan', 'floor' => 6, 'lat' => 719, 'lng' => 631],

        ['id' => 633, 'name' => 'Persimpangan Depan Ruangan 601 dan 602', 'floor' => 6, 'lat' => 615, 'lng' => 1165],
        // ['id' => 634, 'name' => 'Persimpangan Depan Ruangan 602', 'floor' => 6, 'lat' => 615, 'lng' => 1091],
        ['id' => 635, 'name' => 'Persimpangan Depan Ruangan 603 dan 604', 'floor' => 6, 'lat' => 531, 'lng' => 1165],
        // ['id' => 636, 'name' => 'Persimpangan Depan Ruangan 604', 'floor' => 6, 'lat' => 196, 'lng' => 1091],
        ['id' => 637, 'name' => 'Persimpangan Depan Laboratorium 605', 'floor' => 6, 'lat' => 196, 'lng' => 238],
        // ['id' => 638, 'name' => 'Persimpangan Depan Ruangan 606', 'floor' => 6, 'lat' => 196, 'lng' => 453],

        ['id' => 639, 'name' => 'Persimpangan Depan Tangga Naik', 'floor' => 6, 'lat' => 512, 'lng' => 1815],
        ['id' => 640, 'name' => 'Persimpangan Depan Tangga Turun', 'floor' => 6, 'lat' => 512, 'lng' => 1723],

        // Stairs & Elevator
        ['id' => 641, 'name' => 'Elevator', 'floor' => 6, 'lat' => 759, 'lng' => 126],
        ['id' => 642, 'name' => 'Tangga Naik', 'floor' => 6, 'lat' => 554, 'lng' => 1815],
        ['id' => 643, 'name' => 'Tangga Turun', 'floor' => 6, 'lat' => 554, 'lng' => 1723],

        // Corridors
        ['id' => 650, 'name' => 'Depan Toilet', 'floor' => 6, 'lat' => 624, 'lng' => 436],
        ['id' => 651, 'name' => 'Lorong Kiri-Atas', 'floor' => 6, 'lat' => 624, 'lng' => 126],
        ['id' => 652, 'name' => 'Lorong Kiri-Bawah', 'floor' => 6, 'lat' => 196, 'lng' => 126],
        ['id' => 653, 'name' => 'Lorong Kanan-Bawah', 'floor' => 6, 'lat' => 196, 'lng' => 1606],
        ['id' => 654, 'name' => 'Lorong Kanan-Tengah', 'floor' => 6, 'lat' => 512, 'lng' => 1606],
        ['id' => 655, 'name' => 'Lorong Kanan-Atas', 'floor' => 6, 'lat' => 911, 'lng' => 1606],
        ['id' => 656, 'name' => 'Lorong Tengah-Tengah', 'floor' => 6, 'lat' => 624, 'lng' => 747],
        ['id' => 657, 'name' => 'Lorong Tengah-Atas', 'floor' => 6, 'lat' => 911, 'lng' => 747],
        ['id' => 658, 'name' => 'Lorong Tengah-Bawah', 'floor' => 6, 'lat' => 196, 'lng' => 747],
        ['id' => 659, 'name' => 'Lorong Kelas-Bawah', 'floor' => 6, 'lat' => 196, 'lng' => 1165],
        ['id' => 660, 'name' => 'Lorong Kelas-Atas', 'floor' => 6, 'lat' => 911, 'lng' => 1165],
        ];

        DB::table('nodes')->insert($nodes);

        $nodeMap = [];
        foreach ($nodes as $node) {
            $nodeMap[$node['id']] = $node;
        }

        $edges = [
            // Lorong
            ['from_node_id' => 651, 'to_node_id' => 652, 'is_stairs' => 0],
            ['from_node_id' => 651, 'to_node_id' => 650, 'is_stairs' => 0],
            ['from_node_id' => 656, 'to_node_id' => 650, 'is_stairs' => 0],
            ['from_node_id' => 656, 'to_node_id' => 657, 'is_stairs' => 0],
            ['from_node_id' => 660, 'to_node_id' => 657, 'is_stairs' => 0],
            ['from_node_id' => 660, 'to_node_id' => 655, 'is_stairs' => 0],
            ['from_node_id' => 654, 'to_node_id' => 655, 'is_stairs' => 0],
            ['from_node_id' => 654, 'to_node_id' => 653, 'is_stairs' => 0],
            ['from_node_id' => 659, 'to_node_id' => 653, 'is_stairs' => 0],
            ['from_node_id' => 659, 'to_node_id' => 658, 'is_stairs' => 0],
            ['from_node_id' => 637, 'to_node_id' => 658, 'is_stairs' => 0],
            ['from_node_id' => 637, 'to_node_id' => 652, 'is_stairs' => 0],
            ['from_node_id' => 658, 'to_node_id' => 656, 'is_stairs' => 0],

            // Lorong Kelas
            ['from_node_id' => 659, 'to_node_id' => 635, 'is_stairs' => 0],
            ['from_node_id' => 633, 'to_node_id' => 635, 'is_stairs' => 0],
            ['from_node_id' => 633, 'to_node_id' => 660, 'is_stairs' => 0],


            // Elevator & Tangga
            ['from_node_id' => 641, 'to_node_id' => 651, 'is_stairs' => 0],
            ['from_node_id' => 640, 'to_node_id' => 654, 'is_stairs' => 0],
            ['from_node_id' => 640, 'to_node_id' => 643, 'is_stairs' => 0],
            ['from_node_id' => 639, 'to_node_id' => 640, 'is_stairs' => 0],
            ['from_node_id' => 639, 'to_node_id' => 642, 'is_stairs' => 0],

            

            // WC
            ['from_node_id' => 650, 'to_node_id' => 630, 'is_stairs' => 0],
            ['from_node_id' => 632, 'to_node_id' => 630, 'is_stairs' => 0],
            ['from_node_id' => 631, 'to_node_id' => 620, 'is_stairs' => 0],
            ['from_node_id' => 631, 'to_node_id' => 630, 'is_stairs' => 0],
            ['from_node_id' => 632, 'to_node_id' => 621, 'is_stairs' => 0],




            // Ruangan
            ['from_node_id' => 611, 'to_node_id' => 633, 'is_stairs' => 0],
            ['from_node_id' => 610, 'to_node_id' => 633, 'is_stairs' => 0],
            ['from_node_id' => 613, 'to_node_id' => 635, 'is_stairs' => 0],
            ['from_node_id' => 612, 'to_node_id' => 635, 'is_stairs' => 0],
            ['from_node_id' => 614, 'to_node_id' => 637, 'is_stairs' => 0],
            ['from_node_id' => 617, 'to_node_id' => 655, 'is_stairs' => 0],


            // Floors 5-6 //
            ['from_node_id' => 541, 'to_node_id' => 641, 'is_stairs' => 1, 'weight' => 1], //Elevator
            ['from_node_id' => 542, 'to_node_id' => 643, 'is_stairs' => 1, 'weight' => 10], //Tangga
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