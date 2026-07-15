<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NavigationController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// Route::get('/', function () {
//     return route('fakultas');
// });

// In routes/web.php
Route::redirect('/', '/fakultas', 301); // Permanent redirect

Route::get('/fakultas', function () {
    return view('fakultas');
})->name('fakultas');
// Route::get('/gedung', function () {
//     return view('gedung');
// })->name('gedung');
Route::get('/gedung/{gedung}', function ($gedung) {
    return view('gedung', ['gedung' => $gedung]);
});

// Route::get('/info-{info}', function ($info) {
//     return view('info', ['info' => $info]);
// });

Route::get('/info', function () {
    return view('info');
})->name('info');
Route::get('/denah', function () {
    return view('denah');
})->name('denah');
Route::get('/denah-dev', function () {
    return view('denah-dev');
})->name('denah-dev');
Route::get('/navigasi', function () {
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

    $ongoingClasses = DB::table('jadwal')
        ->join('ruangan', 'jadwal.kode_ruangan', '=', 'ruangan.kode_ruangan')
        ->join('dosen', 'jadwal.kode_dosen', '=', 'dosen.kode_dosen')
        ->where('jadwal.hari', $currentDay)
        ->where('jadwal.jam_mulai', '<=', $currentTime)
        ->where('jadwal.jam_selesai', '>=', $currentTime)
        ->select(
            'ruangan.nama_ruangan',
            'jadwal.nama_matkul',
            'jadwal.jam_mulai',
            'jadwal.jam_selesai',
            'dosen.nama_dosen'
        )
        ->get();

    return view('navigasi', compact('ongoingClasses', 'currentDay', 'currentTime'));
})->name('navigation');
Route::get('/denah-manual', function () {
    return view('denah-manual');
})->name('denah-manual');



Route::get('/api/navigation', [NavigationController::class, 'findPath']);
Route::get('/api/navigation-debug', [NavigationController::class, 'findPathDebug']);
Route::get('/api/graph-data', [NavigationController::class, 'getGraphData']);
Route::get('/api/nodes', [NavigationController::class, 'getAllNodes']);
