<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NavigationController extends Controller
{
    public function index()
    {
        $dayMap = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        $now = Carbon::now();
        $currentDay = $dayMap[$now->dayOfWeek];
        $currentTime = $now->format('H:i');

        // Query schedules for the entire day, ordered by start time
        $ongoingClasses = DB::table('jadwal')
            ->join('ruangan', 'jadwal.kode_ruangan', '=', 'ruangan.kode_ruangan')
            ->join('dosen', 'jadwal.kode_dosen', '=', 'dosen.kode_dosen')
            ->where('jadwal.hari', $currentDay)
            ->select(
                'ruangan.nama_ruangan',
                'jadwal.nama_matkul',
                'jadwal.jam_mulai',
                'jadwal.jam_selesai',
                'dosen.nama_dosen'
            )
            ->orderBy('jadwal.jam_mulai', 'asc')
            ->get();

        return view('navigasi', compact('ongoingClasses', 'currentDay', 'currentTime'));
    }

    public function ruanganDetail(Request $request)
    {
        $kode_ruangan = $request->query('kode_ruangan') ?? $request->query('room');
        $kode_dosen = $request->query('kode_dosen') ?? $request->query('dosen');
        $id_node = $request->query('id_node') ?? $request->query('node');

        $ruangan = null;
        $dosen = null;
        $roomNode = null;
        $schedules = collect();

        if ($kode_dosen) {
            $dosen = DB::table('dosen')->where('kode_dosen', $kode_dosen)->first();
            if ($dosen) {
                $schedules = DB::table('jadwal')
                    ->join('ruangan', 'jadwal.kode_ruangan', '=', 'ruangan.kode_ruangan')
                    ->where('jadwal.kode_dosen', $kode_dosen)
                    ->select(
                        'jadwal.nama_matkul',
                        'jadwal.hari',
                        'jadwal.jam_mulai',
                        'jadwal.jam_selesai',
                        'ruangan.nama_ruangan'
                    )
                    ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
                    ->orderBy('jadwal.jam_mulai', 'asc')
                    ->get();
            }
        } else {
            if ($id_node) {
                $ruangan = DB::table('ruangan')->where('id_node', $id_node)->first();
                if (!$ruangan) {
                    return redirect()->route('navigation')->with('warning', 'Ruangan tidak ditemukan atau tidak memiliki data jadwal.');
                }
                $kode_ruangan = $ruangan->kode_ruangan;
            }

            if (!$kode_ruangan) {
                $kode_ruangan = 'R0014';
            }

            $ruangan = DB::table('ruangan')
                ->where('kode_ruangan', $kode_ruangan)
                ->first();

            if (!$ruangan) {
                $ruangan = DB::table('ruangan')->first();
                $kode_ruangan = $ruangan ? $ruangan->kode_ruangan : null;
            }

            if ($ruangan) {
                $schedules = DB::table('jadwal')
                    ->join('dosen', 'jadwal.kode_dosen', '=', 'dosen.kode_dosen')
                    ->where('jadwal.kode_ruangan', $kode_ruangan)
                    ->select(
                        'jadwal.nama_matkul',
                        'jadwal.hari',
                        'jadwal.jam_mulai',
                        'jadwal.jam_selesai',
                        'dosen.nama_dosen'
                    )
                    ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
                    ->orderBy('jadwal.jam_mulai', 'asc')
                    ->get();

                $roomNode = DB::table('nodes')
                    ->where('id', $ruangan->id_node)
                    ->first();
            }
        }

        return view('ruangan', compact('ruangan', 'dosen', 'schedules', 'roomNode'));
    }

    public function getSearchOptions()
    {
        $rooms = DB::table('ruangan')->select('kode_ruangan', 'nama_ruangan')->get();
        $lecturers = DB::table('dosen')->select('kode_dosen', 'nama_dosen')->get();

        return response()->json([
            'rooms' => $rooms,
            'lecturers' => $lecturers,
        ]);
    }
}
