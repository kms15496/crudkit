<?php

namespace Kaung\CrudKit;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class CrudKitServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Load package views
        $this->loadViewsFrom(__DIR__.'/resources/views', 'crudkit');

        // Publish views
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/crudkit'),
        ], 'crudkit-views');

        // Publish config
        $this->publishes([
            __DIR__.'/config/crudkit.php' => config_path('crudkit.php'),
        ], 'crudkit-config');

        // Load routes
        if (! $this->app->routesAreCached()) {
            Route::middleware(config('crudkit.middleware', ['web', 'auth']))
                 ->prefix(config('crudkit.prefix', 'crudkit'))
                 ->group(__DIR__.'/routes/crudkit.php');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/config/crudkit.php', 'crudkit');
    }
}