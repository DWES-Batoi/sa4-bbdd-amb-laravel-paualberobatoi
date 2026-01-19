<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ELIMINA cualquier línea aquí que diga algo como:
        // $this->app->bind(JugadoraRepository::class, function ...);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}