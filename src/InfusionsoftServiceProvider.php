<?php

namespace Upwebdesign\Infusionsoft;

/**
 * This file is part of Infusionsoft
 *
 * @license MIT
 * @package Upwebdesign\Infusionsoft
 */

use Illuminate\Support\ServiceProvider;

class InfusionsoftServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */

    protected $defer = false;
    /**
     * Bootstrap the application events.
     *
     * @return void
     */

    public function boot()
    {
        $this->registerRoutes();
        // Publish config files
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('infusionsoft.php'),
        ]);
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

        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'infusionsoft'
        );
    }

    /**
     * Register routes for the service provider
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group([
            'namespace' => 'Upwebdesign\Infusionsoft\Http\Controllers',
            'middleware' => 'web',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    /**
     * Get the services provided.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
