<?php

namespace Database\Seeders\FloorsGraph;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Floor9Seeder extends Seeder
{
    public function run()
    {
        $nodes = [
        // Facilities
        ['id' => 910, 'name' => 'Ruangan 901', 'floor' => 9, 'lat' => 615, 'lng' => 1248],
        ['id' => 911, 'name' => 'Ruangan 902', 'floor' => 9, 'lat' => 615, 'lng' => 1077],
        ['id' => 912, 'name' => 'Ruangan 903', 'floor' => 9, 'lat' => 531, 'lng' => 1248],
        ['id' => 913, 'name' => 'Ruangan 904', 'floor' => 9, 'lat' => 531, 'lng' => 1077],
        ['id' => 914, 'name' => 'Laboratorium 905', 'floor' => 9, 'lat' => 252, 'lng' => 238],
        // ['id' => 915, 'name' => 'Ruangan 606', 'floor' => 9, 'lat' => 269, 'lng' => 453],
        // ['id' => 916, 'name' => 'Teras Baca', 'floor' => 9, 'lat' => 179, 'lng' => 1629],
        ['id' => 917, 'name' => 'Gudang', 'floor' => 9, 'lat' => 911, 'lng' => 1682],

        // Toilets
        ['id' => 920, 'name' => 'Toilet Laki-laki', 'floor' => 9, 'lat' => 757, 'lng' => 235],
        ['id' => 921, 'name' => 'Toilet Perempuan', 'floor' => 9, 'lat' => 757, 'lng' => 631],

        // Intersections
        ['id' => 930, 'name' => 'Persimpangan Toilet', 'floor' => 9, 'lat' => 719, 'lng' => 436],
        ['id' => 931, 'name' => 'Persimpangan Toilet Laki-laki', 'floor' => 9, 'lat' => 719, 'lng' => 235],
        ['id' => 932, 'name' => 'Persimpangan Toilet Perempuan', 'floor' => 9, 'lat' => 719, 'lng' => 631],

        ['id' => 933, 'name' => 'Persimpangan Depan Ruangan 901 dan 902', 'floor' => 9, 'lat' => 615, 'lng' => 1165],
        // ['id' => 934, 'name' => 'Persimpangan Depan Ruangan 602', 'floor' => 9, 'lat' => 615, 'lng' => 1091],
        ['id' => 935, 'name' => 'Persimpangan Depan Ruangan 903 dan 904', 'floor' => 9, 'lat' => 531, 'lng' => 1165],
        // ['id' => 936, 'name' => 'Persimpangan Depan Ruangan 604', 'floor' => 9, 'lat' => 196, 'lng' => 1091],
        ['id' => 937, 'name' => 'Persimpangan Depan Laboratorium 905', 'floor' => 9, 'lat' => 196, 'lng' => 238],
        // ['id' => 938, 'name' => 'Persimpangan Depan Ruangan 606', 'floor' => 9, 'lat' => 196, 'lng' => 453],

        ['id' => 939, 'name' => 'Persimpangan Depan Tangga Turun', 'floor' => 9, 'lat' => 512, 'lng' => 1815],
        ['id' => 940, 'name' => 'Persimpangan Depan Tangga Naik', 'floor' => 9, 'lat' => 512, 'lng' => 1723],

        // Stairs & Elevator
        ['id' => 941, 'name' => 'Elevator', 'floor' => 9, 'lat' => 759, 'lng' => 126],
        ['id' => 942, 'name' => 'Tangga Turun', 'floor' => 9, 'lat' => 554, 'lng' => 1815],
        ['id' => 943, 'name' => 'Tangga Naik', 'floor' => 9, 'lat' => 554, 'lng' => 1723],

        // Corridors
        ['id' => 950, 'name' => 'Depan Toilet', 'floor' => 9, 'lat' => 624, 'lng' => 436],
        ['id' => 951, 'name' => 'Lorong Kiri-Atas', 'floor' => 9, 'lat' => 624, 'lng' => 126],
        ['id' => 952, 'name' => 'Lorong Kiri-Bawah', 'floor' => 9, 'lat' => 196, 'lng' => 126],
        ['id' => 953, 'name' => 'Lorong Kanan-Bawah', 'floor' => 9, 'lat' => 196, 'lng' => 1606],
        ['id' => 954, 'name' => 'Lorong Kanan-Tengah', 'floor' => 9, 'lat' => 512, 'lng' => 1606],
        ['id' => 955, 'name' => 'Lorong Kanan-Atas', 'floor' => 9, 'lat' => 911, 'lng' => 1606],
        ['id' => 956, 'name' => 'Lorong Tengah-Tengah', 'floor' => 9, 'lat' => 624, 'lng' => 747],
        ['id' => 957, 'name' => 'Lorong Tengah-Atas', 'floor' => 9, 'lat' => 911, 'lng' => 747],
        ['id' => 958, 'name' => 'Lorong Tengah-Bawah', 'floor' => 9, 'lat' => 196, 'lng' => 747],
        ['id' => 959, 'name' => 'Lorong Kelas-Bawah', 'floor' => 9, 'lat' => 196, 'lng' => 1165],
        ['id' => 960, 'name' => 'Lorong Kelas-Atas', 'floor' => 9, 'lat' => 911, 'lng' => 1165],
        ];

        DB::table('nodes')->insert($nodes);

        $nodeMap = [];
        foreach ($nodes as $node) {
            $nodeMap[$node['id']] = $node;
        }

        $edges = [
            // Lorong
            ['from_node_id' => 951, 'to_node_id' => 952, 'is_stairs' => 0],
            ['from_node_id' => 951, 'to_node_id' => 950, 'is_stairs' => 0],
            ['from_node_id' => 956, 'to_node_id' => 950, 'is_stairs' => 0],
            ['from_node_id' => 956, 'to_node_id' => 957, 'is_stairs' => 0],
            ['from_node_id' => 960, 'to_node_id' => 957, 'is_stairs' => 0],
            ['from_node_id' => 960, 'to_node_id' => 955, 'is_stairs' => 0],
            ['from_node_id' => 954, 'to_node_id' => 955, 'is_stairs' => 0],
            ['from_node_id' => 954, 'to_node_id' => 953, 'is_stairs' => 0],
            ['from_node_id' => 959, 'to_node_id' => 953, 'is_stairs' => 0],
            ['from_node_id' => 959, 'to_node_id' => 958, 'is_stairs' => 0],
            ['from_node_id' => 937, 'to_node_id' => 958, 'is_stairs' => 0],
            ['from_node_id' => 937, 'to_node_id' => 952, 'is_stairs' => 0],
            ['from_node_id' => 958, 'to_node_id' => 956, 'is_stairs' => 0],

            // Lorong Kelas
            ['from_node_id' => 959, 'to_node_id' => 935, 'is_stairs' => 0],
            ['from_node_id' => 933, 'to_node_id' => 935, 'is_stairs' => 0],
            ['from_node_id' => 933, 'to_node_id' => 960, 'is_stairs' => 0],


            // Elevator & Tangga
            ['from_node_id' => 941, 'to_node_id' => 951, 'is_stairs' => 0],
            ['from_node_id' => 940, 'to_node_id' => 954, 'is_stairs' => 0],
            ['from_node_id' => 940, 'to_node_id' => 943, 'is_stairs' => 0],
            ['from_node_id' => 939, 'to_node_id' => 940, 'is_stairs' => 0],
            ['from_node_id' => 939, 'to_node_id' => 942, 'is_stairs' => 0],

            

            // WC
            ['from_node_id' => 950, 'to_node_id' => 930, 'is_stairs' => 0],
            ['from_node_id' => 932, 'to_node_id' => 930, 'is_stairs' => 0],
            ['from_node_id' => 931, 'to_node_id' => 920, 'is_stairs' => 0],
            ['from_node_id' => 931, 'to_node_id' => 930, 'is_stairs' => 0],
            ['from_node_id' => 932, 'to_node_id' => 921, 'is_stairs' => 0],




            // Ruangan
            ['from_node_id' => 911, 'to_node_id' => 933, 'is_stairs' => 0],
            ['from_node_id' => 910, 'to_node_id' => 933, 'is_stairs' => 0],
            ['from_node_id' => 913, 'to_node_id' => 935, 'is_stairs' => 0],
            ['from_node_id' => 912, 'to_node_id' => 935, 'is_stairs' => 0],
            ['from_node_id' => 914, 'to_node_id' => 937, 'is_stairs' => 0],
            ['from_node_id' => 917, 'to_node_id' => 955, 'is_stairs' => 0],


            // Floors 5-6 //
            ['from_node_id' => 841, 'to_node_id' => 941, 'is_stairs' => 1, 'weight' => 1], //Elevator
            ['from_node_id' => 843, 'to_node_id' => 942, 'is_stairs' => 1, 'weight' => 10], //Tangga
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