<?php

namespace Database\Seeders\PlansSeed;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('data/jadwal_ruangan_valid.csv');

        if (!file_exists($path)) {
            $this->command->error("File CSV tidak ditemukan.");
            $this->command->error($path);
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Mapping Ruangan
        |--------------------------------------------------------------------------
        |
        | Nama Ruangan -> Kode Ruangan
        |
        */

        $roomMap = DB::table('ruangan')
            ->pluck('kode_ruangan', 'nama_ruangan')
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Mapping Dosen
        |--------------------------------------------------------------------------
        |
        | Nama Dosen -> Kode Dosen
        |
        */

        $lecturerMap = DB::table('dosen')
            ->pluck('kode_dosen', 'nama_dosen')
            ->toArray();

        $file = fopen($path, 'r');

        // Skip Header
        fgetcsv($file);

        $counter = 1;
        $success = 0;
        $failed = 0;

        while (($row = fgetcsv($file)) !== false) {

            $namaMatkul = trim($row[1]);
            $hari       = trim($row[4]);
            $jamMulai   = trim($row[5]);
            $jamSelesai = trim($row[6]);
            $ruangan    = trim($row[8]);
            $dosen      = trim($row[10]);

            // Validasi data wajib
            if (
                $namaMatkul == '' ||
                $hari == '' ||
                $jamMulai == '' ||
                $jamSelesai == '' ||
                $ruangan == '' ||
                $dosen == ''
            ) {

                $failed++;

                $this->command->warn(
                    "Baris dilewati karena data tidak lengkap."
                );

                continue;
            }

            // Cari kode ruangan
            if (!isset($roomMap[$ruangan])) {

                $failed++;

                $this->command->warn(
                    "Ruangan tidak ditemukan : {$ruangan}"
                );

                continue;
            }

            // Cari kode dosen
            if (!isset($lecturerMap[$dosen])) {

                $failed++;

                $this->command->warn(
                    "Dosen tidak ditemukan : {$dosen}"
                );

                continue;
            }

            $kodeRuangan = $roomMap[$ruangan];
            $kodeDosen   = $lecturerMap[$dosen];

            $kodeJadwal = sprintf(
                'J%05d',
                $counter++
            );

            DB::table('jadwal')->updateOrInsert(

                [
                    'kode_jadwal' => $kodeJadwal
                ],

                [

                    'kode_ruangan' => $kodeRuangan,

                    'kode_dosen' => $kodeDosen,

                    'nama_matkul' => $namaMatkul,

                    'hari' => $hari,

                    'jam_mulai' => $jamMulai,

                    'jam_selesai' => $jamSelesai

                ]

            );

            $success++;

            $this->command->info(

                "{$kodeJadwal} | {$namaMatkul} | {$ruangan}"

            );
        }

        fclose($file);

        $this->command->newLine();

        $this->command->info("==============================");

        $this->command->info("Import Jadwal Selesai");

        $this->command->info("==============================");

        $this->command->info("Berhasil : {$success}");

        $this->command->info("Gagal    : {$failed}");
    }
}