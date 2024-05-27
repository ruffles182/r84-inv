<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\MovementObserver;
use App\Models\Movement;

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
        Movement::observe(MovementObserver::class);
        //
    }
}
