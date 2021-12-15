<?php

namespace Upwebdesign\Infusionsoft;

/**
 * This file is part of Infusionsoft
 *
 * @license MIT
 * @package Upwebdesign\Infusionsoft
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Upwebdesign\Infusionsoft\Console\Commands\TokenRefresh;

class InfusionsoftServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */

    public function boot()
    {
        $this->registerRoutes();
        // Publish config files
        $this->publishes(
            [
                __DIR__ . '/../config/config.php' => config_path('infusionsoft.php'),
            ],
            'config'
        );
        if ($this->app->runningInConsole()) {
            $this->commands([TokenRefresh::class]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('infusionsoft', function ($app) {
            return new Infusionsoft($app);
        });

        $this->app->alias('infusionsoft', Infusionsoft::class);

        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'infusionsoft');
    }

    /**
     * Register routes for the service provider
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group(
            [
                'prefix' => 'infusionsoft',
                'namespace' => 'Upwebdesign\Infusionsoft\Http\Controllers',
                'middleware' => 'web',
            ],
            function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            }
        );
    }

    /**
     * Get the services provided.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
