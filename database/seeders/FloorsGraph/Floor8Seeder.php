<?php

namespace Database\Seeders\FloorsGraph;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Floor8Seeder extends Seeder
{
    public function run()
    {
        $nodes = [
        // Facilities
        ['id' => 810, 'name' => 'Ruangan 801', 'floor' => 8, 'lat' => 615, 'lng' => 1248],
        ['id' => 811, 'name' => 'Ruangan 802', 'floor' => 8, 'lat' => 615, 'lng' => 1077],
        ['id' => 812, 'name' => 'Ruangan 803', 'floor' => 8, 'lat' => 531, 'lng' => 1248],
        ['id' => 813, 'name' => 'Ruangan 804', 'floor' => 8, 'lat' => 531, 'lng' => 1077],
        ['id' => 814, 'name' => 'Laboratorium 805', 'floor' => 8, 'lat' => 252, 'lng' => 238],
        // ['id' => 815, 'name' => 'Ruangan 606', 'floor' => 8, 'lat' => 269, 'lng' => 453],
        // ['id' => 816, 'name' => 'Teras Baca', 'floor' => 8, 'lat' => 179, 'lng' => 1629],
        ['id' => 817, 'name' => 'Gudang', 'floor' => 8, 'lat' => 911, 'lng' => 1682],

        // Toilets
        ['id' => 820, 'name' => 'Toilet Laki-laki', 'floor' => 8, 'lat' => 757, 'lng' => 235],
        ['id' => 821, 'name' => 'Toilet Perempuan', 'floor' => 8, 'lat' => 757, 'lng' => 631],

        // Intersections
        ['id' => 830, 'name' => 'Persimpangan Toilet', 'floor' => 8, 'lat' => 719, 'lng' => 436],
        ['id' => 831, 'name' => 'Persimpangan Toilet Laki-laki', 'floor' => 8, 'lat' => 719, 'lng' => 235],
        ['id' => 832, 'name' => 'Persimpangan Toilet Perempuan', 'floor' => 8, 'lat' => 719, 'lng' => 631],

        ['id' => 833, 'name' => 'Persimpangan Depan Ruangan 801 dan 802', 'floor' => 8, 'lat' => 615, 'lng' => 1165],
        // ['id' => 834, 'name' => 'Persimpangan Depan Ruangan 602', 'floor' => 8, 'lat' => 615, 'lng' => 1091],
        ['id' => 835, 'name' => 'Persimpangan Depan Ruangan 803 dan 804', 'floor' => 8, 'lat' => 531, 'lng' => 1165],
        // ['id' => 836, 'name' => 'Persimpangan Depan Ruangan 604', 'floor' => 8, 'lat' => 196, 'lng' => 1091],
        ['id' => 837, 'name' => 'Persimpangan Depan Laboratorium 805', 'floor' => 8, 'lat' => 196, 'lng' => 238],
        // ['id' => 838, 'name' => 'Persimpangan Depan Ruangan 606', 'floor' => 8, 'lat' => 196, 'lng' => 453],

        ['id' => 839, 'name' => 'Persimpangan Depan Tangga Turun', 'floor' => 8, 'lat' => 512, 'lng' => 1815],
        ['id' => 840, 'name' => 'Persimpangan Depan Tangga Naik', 'floor' => 8, 'lat' => 512, 'lng' => 1723],

        // Stairs & Elevator
        ['id' => 841, 'name' => 'Elevator', 'floor' => 8, 'lat' => 759, 'lng' => 126],
        ['id' => 842, 'name' => 'Tangga Turun', 'floor' => 8, 'lat' => 554, 'lng' => 1815],
        ['id' => 843, 'name' => 'Tangga Naik', 'floor' => 8, 'lat' => 554, 'lng' => 1723],

        // Corridors
        ['id' => 850, 'name' => 'Depan Toilet', 'floor' => 8, 'lat' => 624, 'lng' => 436],
        ['id' => 851, 'name' => 'Lorong Kiri-Atas', 'floor' => 8, 'lat' => 624, 'lng' => 126],
        ['id' => 852, 'name' => 'Lorong Kiri-Bawah', 'floor' => 8, 'lat' => 196, 'lng' => 126],
        ['id' => 853, 'name' => 'Lorong Kanan-Bawah', 'floor' => 8, 'lat' => 196, 'lng' => 1606],
        ['id' => 854, 'name' => 'Lorong Kanan-Tengah', 'floor' => 8, 'lat' => 512, 'lng' => 1606],
        ['id' => 855, 'name' => 'Lorong Kanan-Atas', 'floor' => 8, 'lat' => 911, 'lng' => 1606],
        ['id' => 856, 'name' => 'Lorong Tengah-Tengah', 'floor' => 8, 'lat' => 624, 'lng' => 747],
        ['id' => 857, 'name' => 'Lorong Tengah-Atas', 'floor' => 8, 'lat' => 911, 'lng' => 747],
        ['id' => 858, 'name' => 'Lorong Tengah-Bawah', 'floor' => 8, 'lat' => 196, 'lng' => 747],
        ['id' => 859, 'name' => 'Lorong Kelas-Bawah', 'floor' => 8, 'lat' => 196, 'lng' => 1165],
        ['id' => 860, 'name' => 'Lorong Kelas-Atas', 'floor' => 8, 'lat' => 911, 'lng' => 1165],
        ];

        DB::table('nodes')->insert($nodes);

        $nodeMap = [];
        foreach ($nodes as $node) {
            $nodeMap[$node['id']] = $node;
        }

        $edges = [
            // Lorong
            ['from_node_id' => 851, 'to_node_id' => 852, 'is_stairs' => 0],
            ['from_node_id' => 851, 'to_node_id' => 850, 'is_stairs' => 0],
            ['from_node_id' => 856, 'to_node_id' => 850, 'is_stairs' => 0],
            ['from_node_id' => 856, 'to_node_id' => 857, 'is_stairs' => 0],
            ['from_node_id' => 860, 'to_node_id' => 857, 'is_stairs' => 0],
            ['from_node_id' => 860, 'to_node_id' => 855, 'is_stairs' => 0],
            ['from_node_id' => 854, 'to_node_id' => 855, 'is_stairs' => 0],
            ['from_node_id' => 854, 'to_node_id' => 853, 'is_stairs' => 0],
            ['from_node_id' => 859, 'to_node_id' => 853, 'is_stairs' => 0],
            ['from_node_id' => 859, 'to_node_id' => 858, 'is_stairs' => 0],
            ['from_node_id' => 837, 'to_node_id' => 858, 'is_stairs' => 0],
            ['from_node_id' => 837, 'to_node_id' => 852, 'is_stairs' => 0],
            ['from_node_id' => 858, 'to_node_id' => 856, 'is_stairs' => 0],

            // Lorong Kelas
            ['from_node_id' => 859, 'to_node_id' => 835, 'is_stairs' => 0],
            ['from_node_id' => 833, 'to_node_id' => 835, 'is_stairs' => 0],
            ['from_node_id' => 833, 'to_node_id' => 860, 'is_stairs' => 0],


            // Elevator & Tangga
            ['from_node_id' => 841, 'to_node_id' => 851, 'is_stairs' => 0],
            ['from_node_id' => 840, 'to_node_id' => 854, 'is_stairs' => 0],
            ['from_node_id' => 840, 'to_node_id' => 843, 'is_stairs' => 0],
            ['from_node_id' => 839, 'to_node_id' => 840, 'is_stairs' => 0],
            ['from_node_id' => 839, 'to_node_id' => 842, 'is_stairs' => 0],

            

            // WC
            ['from_node_id' => 850, 'to_node_id' => 830, 'is_stairs' => 0],
            ['from_node_id' => 832, 'to_node_id' => 830, 'is_stairs' => 0],
            ['from_node_id' => 831, 'to_node_id' => 820, 'is_stairs' => 0],
            ['from_node_id' => 831, 'to_node_id' => 830, 'is_stairs' => 0],
            ['from_node_id' => 832, 'to_node_id' => 821, 'is_stairs' => 0],




            // Ruangan
            ['from_node_id' => 811, 'to_node_id' => 833, 'is_stairs' => 0],
            ['from_node_id' => 810, 'to_node_id' => 833, 'is_stairs' => 0],
            ['from_node_id' => 813, 'to_node_id' => 835, 'is_stairs' => 0],
            ['from_node_id' => 812, 'to_node_id' => 835, 'is_stairs' => 0],
            ['from_node_id' => 814, 'to_node_id' => 837, 'is_stairs' => 0],
            ['from_node_id' => 817, 'to_node_id' => 855, 'is_stairs' => 0],


            // Floors 5-6 //
            ['from_node_id' => 741, 'to_node_id' => 841, 'is_stairs' => 1, 'weight' => 1], //Elevator
            ['from_node_id' => 743, 'to_node_id' => 842, 'is_stairs' => 1, 'weight' => 10], //Tangga
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