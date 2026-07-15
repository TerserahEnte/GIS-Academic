<?php

namespace Database\Seeders\PlansSeed;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('data/jadwal_ruangan_valid.csv');

        if (! file_exists($path)) {
            $this->command->error('File CSV tidak ditemukan:');
            $this->command->error($path);

            return;
        }

        $file = fopen($path, 'r');

        // Header CSV
        $header = fgetcsv($file);

        $rooms = [];

        while (($row = fgetcsv($file)) !== false) {

            $roomName = trim($row[8]); // Ruangan
            $nodeId = intval($row[9]); // Node ID

            if ($roomName == '') {
                continue;
            }

            // Hindari duplikat
            if (isset($rooms[$roomName])) {
                continue;
            }

            $rooms[$roomName] = [
                'id_node' => $nodeId,
                'nama_ruangan' => $roomName,
            ];
        }

        fclose($file);

        // Urutkan berdasarkan id_node agar mengikuti urutan graf
        uasort($rooms, function ($a, $b) {
            return $a['id_node'] <=> $b['id_node'];
        });

        $counter = 1;

        foreach ($rooms as $room) {

            $kodeRuangan = sprintf(
                'R%04d',
                $counter++
            );

            DB::table('ruangan')->updateOrInsert(

                [
                    'kode_ruangan' => $kodeRuangan,
                ],

                [
                    'id_node' => $room['id_node'],
                    'nama_ruangan' => $room['nama_ruangan'],
                    'deskripsi' => '',
                ]

            );

            $this->command->info(
                "{$kodeRuangan} -> {$room['nama_ruangan']} (Node {$room['id_node']})"
            );
        }
        $this->command->info('');
        $this->command->info(
            count($rooms).' ruangan berhasil diimport.'
        );
    }
}
