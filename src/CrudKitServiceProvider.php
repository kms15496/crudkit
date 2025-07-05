<?php

namespace Kaung\CrudKit;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudKitServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('crudkit::partials.sidebar', \Kaung\CrudKit\View\Composers\SidebarComposer::class);

        /* -----------------------------------------------------------------
         | 1.  Views (load + publish)
         * -----------------------------------------------------------------*/
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'crudkit');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/crudkit'),
        ], 'crudkit-views');

        /* -----------------------------------------------------------------
         | 2.  Config (publish + merge)
         * -----------------------------------------------------------------*/
        $this->publishes([
            __DIR__ . '/config/crudkit.php' => config_path('crudkit.php'),
        ], 'crudkit-config');

        // localisation config (fallback locale etc.)
        $this->publishes([
            __DIR__ . '/config/laravellocalization.php' => config_path('laravellocalization.php'),
        ], 'crudkit-localization-config');

        $this->mergeConfigFrom(
            __DIR__ . '/config/laravellocalization.php',
            'laravellocalization'
        );

        /* -----------------------------------------------------------------
         | 3.  Translations (load + publish)
         * -----------------------------------------------------------------*/
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'crudkit');

        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/crudkit'),
        ], 'crudkit-lang');

        /* -----------------------------------------------------------------
         | 4.  Public assets
         * -----------------------------------------------------------------*/
        $this->publishes([
            __DIR__ . '/public' => public_path('vendor/crudkit'),
        ], 'crudkit-assets');

        $this->publishes([
            __DIR__ . '/config/sidebar.php' => config_path('sidebar.php'),
        ], 'crudkit-sidebar-config');

        /* -----------------------------------------------------------------
         | 5.  Layout overrides
         * -----------------------------------------------------------------*/
        $this->publishes([
            __DIR__ . '/resources/views/layouts/app.blade.php'   => resource_path('views/layouts/app.blade.php'),
            __DIR__ . '/resources/views/layouts/form-layout.blade.php'  => resource_path('views/layouts/form-layout.blade.php'),
            __DIR__ . '/resources/views/layouts/table-layout.blade.php' => resource_path('views/layouts/table-layout.blade.php'),
            __DIR__ . '/resources/views/partials/sidebar.blade.php' => resource_path('views/navigation-menu.blade.php'),
        ], 'crudkit-layouts');

        /* -----------------------------------------------------------------
         | 6.  Dynamic locale list for every view
         * -----------------------------------------------------------------*/
        View::composer('*', function ($view) {
            $view->with('crudkitLocales', LaravelLocalization::getSupportedLocales());
            $view->with('currentLocale',  App::getLocale());
        });

        /* -----------------------------------------------------------------
         | 7.  Package routes (wrapped inside localisation prefix/middleware)
         * -----------------------------------------------------------------*/
        if (! $this->app->routesAreCached()) {
            Route::group(
                [
                    'prefix'     => LaravelLocalization::setLocale(),
                    'middleware' => [
                        'web',
                        'localeSessionRedirect',
                        'localizationRedirect',
                        'localeViewPath',
                    ],
                ],
                fn() => Route::prefix(config('crudkit.prefix', 'crudkit'))
                    ->middleware(config('crudkit.middleware', ['auth']))
                    ->group(__DIR__ . '/routes/crudkit.php')
            );
        }
    }

    public function register(): void
    {
        // CrudKit-specific config
        $this->mergeConfigFrom(__DIR__ . '/config/crudkit.php', 'crudkit');
    }
}
