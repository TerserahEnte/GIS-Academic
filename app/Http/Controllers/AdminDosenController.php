<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDosenController extends Controller
{
    /**
     * Display a listing of the lecturers.
     */
    public function index()
    {
        $lecturers = DB::table('dosen')
            ->orderBy('kode_dosen', 'asc')
            ->get();

        return view('admin.dosen', compact('lecturers'));
    }

    /**
     * Store a newly created lecturer.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_dosen' => ['required', 'string', 'max:255', 'unique:dosen,kode_dosen'],
            'nama_dosen' => ['required', 'string', 'max:255'],
        ]);

        DB::table('dosen')->insert($validated);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan!');
    }

    /**
     * Update the specified lecturer.
     */
    public function update(Request $request, $kode_dosen)
    {
        $validated = $request->validate([
            'nama_dosen' => ['required', 'string', 'max:255'],
        ]);

        DB::table('dosen')
            ->where('kode_dosen', $kode_dosen)
            ->update($validated);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil diperbarui!');
    }

    /**
     * Remove the specified lecturer.
     */
    public function destroy($kode_dosen)
    {
        DB::table('dosen')->where('kode_dosen', $kode_dosen)->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil dihapus!');
    }
}
