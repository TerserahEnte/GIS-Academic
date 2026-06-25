<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GraphCoordinatesSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            FloorsGraph\Floor1Seeder::class,
            FloorsGraph\Floor2Seeder::class,
            FloorsGraph\Floor3Seeder::class,
            FloorsGraph\Floor4Seeder::class,
            FloorsGraph\Floor5Seeder::class,
            FloorsGraph\Floor6Seeder::class,
            FloorsGraph\Floor7Seeder::class,
            FloorsGraph\Floor8Seeder::class,
            FloorsGraph\Floor9Seeder::class,
            FloorsGraph\Floor10Seeder::class,
        ]);
    }
}
