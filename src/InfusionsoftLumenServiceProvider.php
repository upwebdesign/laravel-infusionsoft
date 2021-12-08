<?php

namespace Upwebdesign\Infusionsoft;

/**
 * This file is part of Infusionsoft
 *
 * @license MIT
 * @package Upwebdesign\Infusionsoft
 */

use Illuminate\Support\ServiceProvider;

class InfusionsoftLumenServiceProvider extends ServiceProvider
{
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
        $this->registerRoutes();
        $this->app->make('Upwebdesign\Infusionsoft\Http\Controllers\InfusionsoftController');
    }

    /**
     * Register routes for the service provider
     *
     * @return void
     */
    private function registerRoutes()
    {
        $this->app->group(
            [
                'prefix' => 'infusionsoft',
                'namespace' => 'Upwebdesign\Infusionsoft\Http\Controllers',
            ],
            function ($app) {
                $app->get('auth/callback', 'InfusionsoftController@callback');
                $app->get('auth', 'InfusionsoftController@auth');
            }
        );
    }
}
