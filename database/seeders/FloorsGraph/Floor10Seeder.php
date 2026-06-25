<?php

namespace Database\Seeders\FloorsGraph;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Floor10Seeder extends Seeder
{
    public function run()
    {
        $nodes = [
        // Facilities
        ['id' => 1010, 'name' => 'Aula', 'floor' => 10, 'lat' => 262, 'lng' => 945],
        // ['id' => 1011, 'name' => 'Ruangan 902', 'floor' => 10, 'lat' => 615, 'lng' => 1077],
        // ['id' => 1012, 'name' => 'Ruangan 903', 'floor' => 10, 'lat' => 531, 'lng' => 1248],
        // ['id' => 1013, 'name' => 'Ruangan 904', 'floor' => 10, 'lat' => 531, 'lng' => 1077],
        // ['id' => 1014, 'name' => 'Laboratorium 905', 'floor' => 10, 'lat' => 252, 'lng' => 238],
        // ['id' => 1015, 'name' => 'Ruangan 606', 'floor' => 10, 'lat' => 269, 'lng' => 453],
        // ['id' => 1016, 'name' => 'Teras Baca', 'floor' => 10, 'lat' => 179, 'lng' => 1629],
        ['id' => 1017, 'name' => 'Gudang', 'floor' => 10, 'lat' => 911, 'lng' => 1682],

        // Toilets
        // ['id' => 1020, 'name' => 'Toilet Laki-laki', 'floor' => 10, 'lat' => 757, 'lng' => 235],
        // ['id' => 1021, 'name' => 'Toilet Perempuan', 'floor' => 10, 'lat' => 757, 'lng' => 631],

        // Intersections
        // ['id' => 1030, 'name' => 'Persimpangan Toilet', 'floor' => 10, 'lat' => 719, 'lng' => 436],
        // ['id' => 1031, 'name' => 'Persimpangan Toilet Laki-laki', 'floor' => 10, 'lat' => 719, 'lng' => 235],
        // ['id' => 1032, 'name' => 'Persimpangan Toilet Perempuan', 'floor' => 10, 'lat' => 719, 'lng' => 631],

        ['id' => 1033, 'name' => 'Persimpangan Depan Aula', 'floor' => 10, 'lat' => 196, 'lng' => 945],
        // // ['id' => 1034, 'name' => 'Persimpangan Depan Ruangan 602', 'floor' => 10, 'lat' => 615, 'lng' => 1091],
        // ['id' => 1035, 'name' => 'Persimpangan Depan Ruangan 903 dan 904', 'floor' => 10, 'lat' => 531, 'lng' => 1165],
        // // ['id' => 1036, 'name' => 'Persimpangan Depan Ruangan 604', 'floor' => 10, 'lat' => 196, 'lng' => 1091],
        // ['id' => 1037, 'name' => 'Persimpangan Depan Laboratorium 905', 'floor' => 10, 'lat' => 196, 'lng' => 238],
        // // ['id' => 1038, 'name' => 'Persimpangan Depan Ruangan 606', 'floor' => 10, 'lat' => 196, 'lng' => 453],

        // ['id' => 1039, 'name' => 'Persimpangan Depan Tangga Turun', 'floor' => 10, 'lat' => 512, 'lng' => 1815],
        // ['id' => 1040, 'name' => 'Persimpangan Depan Tangga Naik', 'floor' => 10, 'lat' => 512, 'lng' => 1723],

        // Stairs & Elevator
        ['id' => 1041, 'name' => 'Elevator', 'floor' => 10, 'lat' => 759, 'lng' => 126],
        ['id' => 1042, 'name' => 'Tangga Turun', 'floor' => 10, 'lat' => 554, 'lng' => 1815],
        // ['id' => 1043, 'name' => 'Tangga Naik', 'floor' => 10, 'lat' => 554, 'lng' => 1723],

        // Corridors
        // ['id' => 1050, 'name' => 'Depan Toilet', 'floor' => 10, 'lat' => 624, 'lng' => 436],
        // ['id' => 1051, 'name' => 'Lorong Kiri-Atas', 'floor' => 10, 'lat' => 624, 'lng' => 126],
        ['id' => 1052, 'name' => 'Lorong Kiri-Bawah', 'floor' => 10, 'lat' => 196, 'lng' => 126],
        ['id' => 1053, 'name' => 'Lorong Kanan-Bawah', 'floor' => 10, 'lat' => 196, 'lng' => 1815],
        // ['id' => 1054, 'name' => 'Lorong Kanan-Tengah', 'floor' => 10, 'lat' => 512, 'lng' => 1606],
        // ['id' => 1055, 'name' => 'Lorong Kanan-Atas', 'floor' => 10, 'lat' => 911, 'lng' => 1606],
        // ['id' => 1056, 'name' => 'Lorong Tengah-Tengah', 'floor' => 10, 'lat' => 624, 'lng' => 747],
        // ['id' => 1057, 'name' => 'Lorong Tengah-Atas', 'floor' => 10, 'lat' => 911, 'lng' => 747],
        // ['id' => 1058, 'name' => 'Lorong Tengah-Bawah', 'floor' => 10, 'lat' => 196, 'lng' => 747],
        // ['id' => 1059, 'name' => 'Lorong Kelas-Bawah', 'floor' => 10, 'lat' => 196, 'lng' => 1165],
        // ['id' => 1060, 'name' => 'Lorong Kelas-Atas', 'floor' => 10, 'lat' => 911, 'lng' => 1165],
        ];

        DB::table('nodes')->insert($nodes);

        $nodeMap = [];
        foreach ($nodes as $node) {
            $nodeMap[$node['id']] = $node;
        }

        $edges = [
            // Lorong
            ['from_node_id' => 1052, 'to_node_id' => 1033, 'is_stairs' => 0],
            ['from_node_id' => 1053, 'to_node_id' => 1033, 'is_stairs' => 0],
            // Lorong Kelas


            // Elevator & Tangga
            ['from_node_id' => 1052, 'to_node_id' => 1041, 'is_stairs' => 0],
            ['from_node_id' => 1053, 'to_node_id' => 1042, 'is_stairs' => 0],
            

            // WC




            // Ruangan
            ['from_node_id' => 1010, 'to_node_id' => 1033, 'is_stairs' => 0],


            // Floors 5-6 //
            ['from_node_id' => 941, 'to_node_id' => 1041, 'is_stairs' => 1, 'weight' => 1], //Elevator
            ['from_node_id' => 943, 'to_node_id' => 1042, 'is_stairs' => 1, 'weight' => 10], //Tangga
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