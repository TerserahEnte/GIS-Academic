<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NavigationController;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return route('fakultas');
// });

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\AdminJadwalController;
use App\Http\Controllers\AdminRuanganController;
use App\Http\Controllers\AdminDosenController;
use App\Http\Controllers\AdminGraphController;

Route::middleware('auth')->group(function () {
    // Jadwal
    Route::get('/admin', [AdminJadwalController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/jadwal', [AdminJadwalController::class, 'store'])->name('admin.jadwal.store');
    Route::put('/admin/jadwal/{kode_jadwal}', [AdminJadwalController::class, 'update'])->name('admin.jadwal.update');
    Route::delete('/admin/jadwal/{kode_jadwal}', [AdminJadwalController::class, 'destroy'])->name('admin.jadwal.destroy');

    // Ruangan
    Route::get('/admin/ruangan', [AdminRuanganController::class, 'index'])->name('admin.ruangan.index');
    Route::post('/admin/ruangan', [AdminRuanganController::class, 'store'])->name('admin.ruangan.store');
    Route::put('/admin/ruangan/{kode_ruangan}', [AdminRuanganController::class, 'update'])->name('admin.ruangan.update');
    Route::delete('/admin/ruangan/{kode_ruangan}', [AdminRuanganController::class, 'destroy'])->name('admin.ruangan.destroy');

    // Dosen
    Route::get('/admin/dosen', [AdminDosenController::class, 'index'])->name('admin.dosen.index');
    Route::post('/admin/dosen', [AdminDosenController::class, 'store'])->name('admin.dosen.store');
    Route::put('/admin/dosen/{kode_dosen}', [AdminDosenController::class, 'update'])->name('admin.dosen.update');
    Route::delete('/admin/dosen/{kode_dosen}', [AdminDosenController::class, 'destroy'])->name('admin.dosen.destroy');

    // Node & Edge (Graph)
    Route::get('/admin/graph', [AdminGraphController::class, 'index'])->name('admin.graph.index');
    Route::post('/admin/nodes', [AdminGraphController::class, 'storeNode'])->name('admin.nodes.store');
    Route::put('/admin/nodes/{id}', [AdminGraphController::class, 'updateNode'])->name('admin.nodes.update');
    Route::delete('/admin/nodes/{id}', [AdminGraphController::class, 'destroyNode'])->name('admin.nodes.destroy');
    Route::post('/admin/edges', [AdminGraphController::class, 'storeEdge'])->name('admin.edges.store');
    Route::put('/admin/edges/{id}', [AdminGraphController::class, 'updateEdge'])->name('admin.edges.update');
    Route::delete('/admin/edges/{id}', [AdminGraphController::class, 'destroyEdge'])->name('admin.edges.destroy');
});



// In routes/web.php
Route::redirect('/', '/navigasi', 301); // Permanent redirect

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
Route::get('/navigasi', [\App\Http\Controllers\NavigationController::class, 'index'])->name('navigation');
Route::get('/denah-manual', function () {
    return view('denah-manual');
})->name('denah-manual');

Route::get('/ruangan', [\App\Http\Controllers\NavigationController::class, 'ruanganDetail'])->name('ruangan');


Route::get('/api/navigation', [NavigationController::class, 'findPath']);
Route::get('/api/navigation-debug', [NavigationController::class, 'findPathDebug']);
Route::get('/api/graph-data', [NavigationController::class, 'getGraphData']);
Route::get('/api/nodes', [NavigationController::class, 'getAllNodes']);
Route::get('/api/search-options', [\App\Http\Controllers\NavigationController::class, 'getSearchOptions']);
