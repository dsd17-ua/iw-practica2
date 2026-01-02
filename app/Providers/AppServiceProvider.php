<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <--- 1. AÑADE ESTA LÍNEA ARRIBA

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
        // Si estamos en producción (Railway), forzamos HTTPS
        if ($this->app->environment('production')) {  // <--- 2. AÑADE ESTE BLOQUE IF
            URL::forceScheme('https');
        }
    }
}