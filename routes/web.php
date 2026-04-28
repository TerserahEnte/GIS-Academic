<?php

use Illuminate\Support\Facades\Route;

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