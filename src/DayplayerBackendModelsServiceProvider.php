<?php

namespace Dayplayer\BackendModels;

use Illuminate\Support\ServiceProvider;

class DayplayerBackendModelsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations/');
    }
}
