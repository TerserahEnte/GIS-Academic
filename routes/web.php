<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NavigationController;

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
    return view('navigation');
})->name('navigation');



Route::get('/api/navigation', [NavigationController::class, 'findPath']);
Route::get('/api/graph-data', [NavigationController::class, 'getGraphData']);
