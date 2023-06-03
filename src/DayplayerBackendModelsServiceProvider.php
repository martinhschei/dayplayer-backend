<?php

namespace Dayplayer\BackendModels;

use Illuminate\Support\ServiceProvider;

class DayplayerBackendModelsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations/');
        $this->withFactories(realpath(__DIR__.'/factories/'));
    }
}
