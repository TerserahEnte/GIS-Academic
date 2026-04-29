<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NavigationController;

Route::get('/navigation', [NavigationController::class, 'findPath']);
