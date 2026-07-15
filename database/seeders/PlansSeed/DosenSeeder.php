<?php

namespace Database\Seeders\PlansSeed;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('data/jadwal_ruangan_valid.csv');

        if (!file_exists($path)) {
            $this->command->error("File CSV tidak ditemukan:");
            $this->command->error($path);
            return;
        }

        $file = fopen($path, 'r');

        // Skip header
        fgetcsv($file);

        $lecturers = [];

        while (($row = fgetcsv($file)) !== false) {

            // Ambil Dosen 1 dan Dosen 2
            $lecturerList = [
                trim($row[10]),
                trim($row[11])
            ];

            foreach ($lecturerList as $lecturer) {

                if ($lecturer == '') {
                    continue;
                }

                // Hindari duplikat
                if (isset($lecturers[$lecturer])) {
                    continue;
                }

                $lecturers[$lecturer] = true;
            }
        }

        fclose($file);

        ksort($lecturers);

        $counter = 1;

        foreach ($lecturers as $name => $dummy) {

            $kodeDosen = sprintf(
                'D%04d',
                $counter++
            );

            DB::table('dosen')->updateOrInsert(

                [
                    'kode_dosen' => $kodeDosen
                ],

                [
                    'nama_dosen' => $name
                ]

            );

            $this->command->info(
                "{$kodeDosen} -> {$name}"
            );
        }

        $this->command->newLine();

        $this->command->info(
            count($lecturers) . " dosen berhasil diimport."
        );
    }
}