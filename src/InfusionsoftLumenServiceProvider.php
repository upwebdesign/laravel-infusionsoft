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
    }
}
