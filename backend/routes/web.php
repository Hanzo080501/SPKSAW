<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\SAWController;

Route::get('/', function () {
    return redirect()->to('/admin/login');
});

// Route::get('/calculate-saw', [SAWController::class, 'calculateSAW']);
