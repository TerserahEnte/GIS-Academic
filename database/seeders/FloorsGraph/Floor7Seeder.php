<?php

namespace Database\Seeders\FloorsGraph;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Floor7Seeder extends Seeder
{
    public function run()
    {
        $nodes = [
        // Facilities
        ['id' => 710, 'name' => 'Ruangan 701', 'floor' => 7, 'lat' => 615, 'lng' => 1248],
        ['id' => 711, 'name' => 'Ruangan 702', 'floor' => 7, 'lat' => 615, 'lng' => 1077],
        ['id' => 712, 'name' => 'Ruangan 703', 'floor' => 7, 'lat' => 531, 'lng' => 1248],
        ['id' => 713, 'name' => 'Ruangan 704', 'floor' => 7, 'lat' => 531, 'lng' => 1077],
        ['id' => 714, 'name' => 'Laboratorium 705', 'floor' => 7, 'lat' => 252, 'lng' => 238],
        // ['id' => 715, 'name' => 'Ruangan 606', 'floor' => 7, 'lat' => 269, 'lng' => 453],
        // ['id' => 716, 'name' => 'Teras Baca', 'floor' => 7, 'lat' => 179, 'lng' => 1629],
        ['id' => 717, 'name' => 'Gudang', 'floor' => 7, 'lat' => 911, 'lng' => 1682],

        // Toilets
        ['id' => 720, 'name' => 'Toilet Laki-laki', 'floor' => 7, 'lat' => 757, 'lng' => 235],
        ['id' => 721, 'name' => 'Toilet Perempuan', 'floor' => 7, 'lat' => 757, 'lng' => 631],

        // Intersections
        ['id' => 730, 'name' => 'Persimpangan Toilet', 'floor' => 7, 'lat' => 719, 'lng' => 436],
        ['id' => 731, 'name' => 'Persimpangan Toilet Laki-laki', 'floor' => 7, 'lat' => 719, 'lng' => 235],
        ['id' => 732, 'name' => 'Persimpangan Toilet Perempuan', 'floor' => 7, 'lat' => 719, 'lng' => 631],

        ['id' => 733, 'name' => 'Persimpangan Depan Ruangan 701 dan 702', 'floor' => 7, 'lat' => 615, 'lng' => 1165],
        // ['id' => 734, 'name' => 'Persimpangan Depan Ruangan 602', 'floor' => 7, 'lat' => 615, 'lng' => 1091],
        ['id' => 735, 'name' => 'Persimpangan Depan Ruangan 703 dan 704', 'floor' => 7, 'lat' => 531, 'lng' => 1165],
        // ['id' => 736, 'name' => 'Persimpangan Depan Ruangan 604', 'floor' => 7, 'lat' => 196, 'lng' => 1091],
        ['id' => 737, 'name' => 'Persimpangan Depan Laboratorium 705', 'floor' => 7, 'lat' => 196, 'lng' => 238],
        // ['id' => 738, 'name' => 'Persimpangan Depan Ruangan 606', 'floor' => 7, 'lat' => 196, 'lng' => 453],

        ['id' => 739, 'name' => 'Persimpangan Depan Tangga Turun', 'floor' => 7, 'lat' => 512, 'lng' => 1815],
        ['id' => 740, 'name' => 'Persimpangan Depan Tangga Naik', 'floor' => 7, 'lat' => 512, 'lng' => 1723],

        // Stairs & Elevator
        ['id' => 741, 'name' => 'Elevator', 'floor' => 7, 'lat' => 759, 'lng' => 126],
        ['id' => 742, 'name' => 'Tangga Turun', 'floor' => 7, 'lat' => 554, 'lng' => 1815],
        ['id' => 743, 'name' => 'Tangga Naik', 'floor' => 7, 'lat' => 554, 'lng' => 1723],

        // Corridors
        ['id' => 750, 'name' => 'Depan Toilet', 'floor' => 7, 'lat' => 624, 'lng' => 436],
        ['id' => 751, 'name' => 'Lorong Kiri-Atas', 'floor' => 7, 'lat' => 624, 'lng' => 126],
        ['id' => 752, 'name' => 'Lorong Kiri-Bawah', 'floor' => 7, 'lat' => 196, 'lng' => 126],
        ['id' => 753, 'name' => 'Lorong Kanan-Bawah', 'floor' => 7, 'lat' => 196, 'lng' => 1606],
        ['id' => 754, 'name' => 'Lorong Kanan-Tengah', 'floor' => 7, 'lat' => 512, 'lng' => 1606],
        ['id' => 755, 'name' => 'Lorong Kanan-Atas', 'floor' => 7, 'lat' => 911, 'lng' => 1606],
        ['id' => 756, 'name' => 'Lorong Tengah-Tengah', 'floor' => 7, 'lat' => 624, 'lng' => 747],
        ['id' => 757, 'name' => 'Lorong Tengah-Atas', 'floor' => 7, 'lat' => 911, 'lng' => 747],
        ['id' => 758, 'name' => 'Lorong Tengah-Bawah', 'floor' => 7, 'lat' => 196, 'lng' => 747],
        ['id' => 759, 'name' => 'Lorong Kelas-Bawah', 'floor' => 7, 'lat' => 196, 'lng' => 1165],
        ['id' => 760, 'name' => 'Lorong Kelas-Atas', 'floor' => 7, 'lat' => 911, 'lng' => 1165],
        ];

        DB::table('nodes')->insert($nodes);

        $nodeMap = [];
        foreach ($nodes as $node) {
            $nodeMap[$node['id']] = $node;
        }

        $edges = [
            // Lorong
            ['from_node_id' => 751, 'to_node_id' => 752, 'is_stairs' => 0],
            ['from_node_id' => 751, 'to_node_id' => 750, 'is_stairs' => 0],
            ['from_node_id' => 756, 'to_node_id' => 750, 'is_stairs' => 0],
            ['from_node_id' => 756, 'to_node_id' => 757, 'is_stairs' => 0],
            ['from_node_id' => 760, 'to_node_id' => 757, 'is_stairs' => 0],
            ['from_node_id' => 760, 'to_node_id' => 755, 'is_stairs' => 0],
            ['from_node_id' => 754, 'to_node_id' => 755, 'is_stairs' => 0],
            ['from_node_id' => 754, 'to_node_id' => 753, 'is_stairs' => 0],
            ['from_node_id' => 759, 'to_node_id' => 753, 'is_stairs' => 0],
            ['from_node_id' => 759, 'to_node_id' => 758, 'is_stairs' => 0],
            ['from_node_id' => 737, 'to_node_id' => 758, 'is_stairs' => 0],
            ['from_node_id' => 737, 'to_node_id' => 752, 'is_stairs' => 0],
            ['from_node_id' => 758, 'to_node_id' => 756, 'is_stairs' => 0],

            // Lorong Kelas
            ['from_node_id' => 759, 'to_node_id' => 735, 'is_stairs' => 0],
            ['from_node_id' => 733, 'to_node_id' => 735, 'is_stairs' => 0],
            ['from_node_id' => 733, 'to_node_id' => 760, 'is_stairs' => 0],


            // Elevator & Tangga
            ['from_node_id' => 741, 'to_node_id' => 751, 'is_stairs' => 0],
            ['from_node_id' => 740, 'to_node_id' => 754, 'is_stairs' => 0],
            ['from_node_id' => 740, 'to_node_id' => 743, 'is_stairs' => 0],
            ['from_node_id' => 739, 'to_node_id' => 740, 'is_stairs' => 0],
            ['from_node_id' => 739, 'to_node_id' => 742, 'is_stairs' => 0],

            

            // WC
            ['from_node_id' => 750, 'to_node_id' => 730, 'is_stairs' => 0],
            ['from_node_id' => 732, 'to_node_id' => 730, 'is_stairs' => 0],
            ['from_node_id' => 731, 'to_node_id' => 720, 'is_stairs' => 0],
            ['from_node_id' => 731, 'to_node_id' => 730, 'is_stairs' => 0],
            ['from_node_id' => 732, 'to_node_id' => 721, 'is_stairs' => 0],




            // Ruangan
            ['from_node_id' => 711, 'to_node_id' => 733, 'is_stairs' => 0],
            ['from_node_id' => 710, 'to_node_id' => 733, 'is_stairs' => 0],
            ['from_node_id' => 713, 'to_node_id' => 735, 'is_stairs' => 0],
            ['from_node_id' => 712, 'to_node_id' => 735, 'is_stairs' => 0],
            ['from_node_id' => 714, 'to_node_id' => 737, 'is_stairs' => 0],
            ['from_node_id' => 717, 'to_node_id' => 755, 'is_stairs' => 0],


            // Floors 5-6 //
            ['from_node_id' => 641, 'to_node_id' => 741, 'is_stairs' => 1, 'weight' => 1], //Elevator
            ['from_node_id' => 643, 'to_node_id' => 742, 'is_stairs' => 1, 'weight' => 10], //Tangga
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