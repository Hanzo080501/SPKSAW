<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::orderBy('ranking', 'asc')->get();
        return CarResource::collection($cars);
    }

    public function show(Car $car)
    {
        // $data = Car::find($car->id);
        return CarResource::make($car);
    }
}
