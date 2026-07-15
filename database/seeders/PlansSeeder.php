<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PlansSeed\RuanganSeeder::class,
            PlansSeed\DosenSeeder::class,
            PlansSeed\JadwalSeeder::class,
        ]);
    }
}