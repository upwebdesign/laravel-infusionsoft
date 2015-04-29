<?php namespace Upwebdesign\Infusionsoft;

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

        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'infusionsoft'
        );
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