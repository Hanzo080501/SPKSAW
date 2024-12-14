<?php

namespace App\Observers;

use App\Http\Controllers\SAWController;
use App\Models\Car;

class CarObserver
{
    /**
     * Handle the Car "created" event.
     */
    public function created(Car $car): void
    {
        $sawController = new SAWController();
        $sawController->calculateSAW();
    }

    /**
     * Handle the Car "updated" event.
     */
    public function updated(Car $car): void
    {
        (new SAWController())->calculateSAW();
        $sawController = new SAWController();
        $sawController->calculateSAW();
    }

    /**
     * Handle the Car "deleted" event.
     */
    public function deleted(Car $car): void
    {
        $sawController = new SAWController();
        $sawController->calculateSAW();
    }

    /**
     * Handle the Car "restored" event.
     */
    public function restored(Car $car): void
    {
        $sawController = new SAWController();
        $sawController->calculateSAW();
    }

    /**
     * Handle the Car "force deleted" event.
     */
    public function forceDeleted(Car $car): void
    {
        $sawController = new SAWController();
        $sawController->calculateSAW();
    }
}
