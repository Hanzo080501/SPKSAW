<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\SAWController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/car/{car:id}', [CarController::class, 'show']);
Route::apiResource('cars', CarController::class);
Route::post('/filter', [SAWController::class, 'calculateSAWWithFilter']);
Route::get('/filter', [SAWController::class, 'calculateSAWWithFilter']);
