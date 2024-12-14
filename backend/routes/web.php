<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\SAWController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/calculate-saw', [SAWController::class, 'calculateSAW']);
