<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRuanganController extends Controller
{
    /**
     * Display a listing of the rooms.
     */
    public function index()
    {
        $rooms = DB::table('ruangan')
            ->join('nodes', 'ruangan.id_node', '=', 'nodes.id')
            ->select('ruangan.*', 'nodes.name as node_name', 'nodes.floor')
            ->orderBy('ruangan.kode_ruangan', 'asc')
            ->get();

        $nodes = DB::table('nodes')->orderBy('name', 'asc')->get();

        return view('admin.ruangan', compact('rooms', 'nodes'));
    }

    /**
     * Store a newly created room.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_ruangan' => ['required', 'string', 'max:255', 'unique:ruangan,kode_ruangan'],
            'id_node' => ['required', 'integer', 'exists:nodes,id'],
            'nama_ruangan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
        ]);

        DB::table('ruangan')->insert($validated);

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan!');
    }

    /**
     * Update the specified room.
     */
    public function update(Request $request, $kode_ruangan)
    {
        $validated = $request->validate([
            'id_node' => ['required', 'integer', 'exists:nodes,id'],
            'nama_ruangan' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
        ]);

        DB::table('ruangan')
            ->where('kode_ruangan', $kode_ruangan)
            ->update($validated);

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diperbarui!');
    }

    /**
     * Remove the specified room.
     */
    public function destroy($kode_ruangan)
    {
        DB::table('ruangan')->where('kode_ruangan', $kode_ruangan)->delete();

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus!');
    }
}
