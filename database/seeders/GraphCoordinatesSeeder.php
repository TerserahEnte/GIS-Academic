<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GraphCoordinatesSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('edges')->truncate();
        DB::table('nodes')->truncate();
        Schema::enableForeignKeyConstraints();

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
