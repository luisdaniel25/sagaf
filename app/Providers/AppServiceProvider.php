<?php

namespace App\Providers;

use App\Models\AsignacionesInstructore;
use App\Observers\AsignacionesInstructorObserver;
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
        $this->registerObservers();
    }

    private function registerObservers(): void
    {
        AsignacionesInstructore::observe(
            AsignacionesInstructorObserver::class
        );
    }
}
