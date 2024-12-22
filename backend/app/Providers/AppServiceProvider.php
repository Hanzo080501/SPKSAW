<?php

namespace App\Providers;

use App\Filament\Pages\ProsesPerhitungan;
use App\Models\Car;
use App\Observers\CarObserver;
use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\View\View;
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
        FilamentView::registerRenderHook(
            'panels::auth.login.form.after',
            fn(): View => view('filament.auth_extra')
        );
        FilamentView::registerRenderHook(
            'panels::auth.register.form.after',
            fn(): View => view('filament.auth_extra')
        );

        FilamentView::registerRenderHook(
            'panels::auth.password-reset.request.form.after',
            fn(): View => view('filament.auth_extra')
        );
    }
}
