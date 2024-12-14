<?php

namespace App\Providers;

use App\Filament\Pages\ProsesPerhitungan;
use App\Models\Car;
use App\Observers\CarObserver;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Car::observe(CarObserver::class);

        Filament::registerPages([
            ProsesPerhitungan::class,  // Tambahkan halaman custom SAWResults
        ]);
    }
}
