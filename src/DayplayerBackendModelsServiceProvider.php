<?php

namespace Dayplayer\BackendModels;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class DayplayerBackendModelsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }
    
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations/');
        $this->registerFactories();
    }

    protected function registerFactories()
    {
        if ($this->app->runningInConsole()) {
            Factory::guessFactoryNamesUsing(function (string $modelName) {
                // Adjust this namespace according to your package's structure
                $namespace = 'Dayplayer\\BackendModels\\Factories\\';

                // Assuming your factory names follow the standard naming convention
                return $namespace . class_basename($modelName) . 'Factory';
            });
        }
    }
}