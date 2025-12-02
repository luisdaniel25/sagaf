<?php

namespace App\Providers;

use App\Services\NotificacionService;
use Illuminate\Support\ServiceProvider;
use App\Models\AsignacionesInstructore;
use App\Observers\AsignacionesInstructorObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(NotificacionService::class, function ($app) {
            return new NotificacionService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar el observer
        AsignacionesInstructore::observe(AsignacionesInstructorObserver::class);
    }
}
