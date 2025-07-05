<?php

namespace Kaung\CrudKit;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CrudKitServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /* -----------------------------------------------------------------
         | 1.  Load, then publish the package views
         * -----------------------------------------------------------------*/
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'crudkit');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/crudkit'),
        ], 'crudkit-views');

        /* -----------------------------------------------------------------
         | 2.  Publish the package config
         * -----------------------------------------------------------------*/
        $this->publishes([
            __DIR__ . '/config/crudkit.php' => config_path('crudkit.php'),
        ], 'crudkit-config');

        /* -----------------------------------------------------------------
         | 3.  Publish public assets  →  public/vendor/crudkit
         * -----------------------------------------------------------------*/
        $this->publishes([
            __DIR__ . '/public' => public_path('vendor/crudkit'),
        ], 'crudkit-assets');

        /* -----------------------------------------------------------------
         | 4.  Overwrite resources/views/layouts/app.blade.php
         * -----------------------------------------------------------------*/
        $this->publishes([
            __DIR__ . '/resources/views/layouts/app.blade.php'
            => resource_path('views/layouts/app.blade.php'),
        ], 'crudkit-app-layout');

        $this->publishes([
            __DIR__ . '/resources/views/layouts/form-layout.blade.php' =>
            resource_path('views/layouts/form-layout.blade.php'),
        ], 'crudkit-form-layout');

        /* -----------------------------------------------------------------
         | 5.  Load package routes
         * -----------------------------------------------------------------*/
        if (! $this->app->routesAreCached()) {
            Route::middleware(config('crudkit.middleware', ['web', 'auth']))
                ->prefix(config('crudkit.prefix', 'crudkit'))
                ->group(__DIR__ . '/routes/crudkit.php');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config/crudkit.php', 'crudkit');
    }
}
