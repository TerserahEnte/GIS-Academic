<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminJadwalController extends Controller
{
    /**
     * Display a listing of the schedules.
     */
    public function index()
    {
        $schedules = DB::table('jadwal')
            ->join('ruangan', 'jadwal.kode_ruangan', '=', 'ruangan.kode_ruangan')
            ->join('dosen', 'jadwal.kode_dosen', '=', 'dosen.kode_dosen')
            ->select('jadwal.*', 'ruangan.nama_ruangan', 'dosen.nama_dosen')
            ->orderBy('jadwal.kode_jadwal', 'asc')
            ->get();

        $rooms = DB::table('ruangan')->orderBy('nama_ruangan', 'asc')->get();
        $lecturers = DB::table('dosen')->orderBy('nama_dosen', 'asc')->get();

        return view('admin.jadwal', compact('schedules', 'rooms', 'lecturers'));
    }

    /**
     * Store a newly created schedule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_jadwal' => ['required', 'string', 'max:255', 'unique:jadwal,kode_jadwal'],
            'kode_ruangan' => ['required', 'string', 'exists:ruangan,kode_ruangan'],
            'kode_dosen' => ['required', 'string', 'exists:dosen,kode_dosen'],
            'nama_matkul' => ['required', 'string', 'max:255'],
            'hari' => ['required', 'string', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            'jam_mulai' => ['required', 'string', 'regex:/^\d{2}:\d{2}$/'],
            'jam_selesai' => ['required', 'string', 'regex:/^\d{2}:\d{2}$/'],
        ]);

        DB::table('jadwal')->insert($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Update the specified schedule.
     */
    public function update(Request $request, $kode_jadwal)
    {
        $validated = $request->validate([
            'kode_ruangan' => ['required', 'string', 'exists:ruangan,kode_ruangan'],
            'kode_dosen' => ['required', 'string', 'exists:dosen,kode_dosen'],
            'nama_matkul' => ['required', 'string', 'max:255'],
            'hari' => ['required', 'string', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            'jam_mulai' => ['required', 'string', 'regex:/^\d{2}:\d{2}$/'],
            'jam_selesai' => ['required', 'string', 'regex:/^\d{2}:\d{2}$/'],
        ]);

        DB::table('jadwal')
            ->where('kode_jadwal', $kode_jadwal)
            ->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Remove the specified schedule.
     */
    public function destroy($kode_jadwal)
    {
        DB::table('jadwal')->where('kode_jadwal', $kode_jadwal)->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal berhasil dihapus!');
    }
}
