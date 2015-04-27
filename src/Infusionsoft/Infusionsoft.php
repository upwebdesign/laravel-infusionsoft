<?php namespace Upwebdesign\Infusionsoft;

/**
 * This class is the main entry point of entrust. Usually this the interaction
 * with this class will be done through the Entrust Facade
 *
 * @license MIT
 * @package Upwebdesign\Infusionsoft
 */

use Infusionsoft\Infusionsoft as Inf;
use \Config;

class Infusionsoft
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new confide instance.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
        $appName =  Config::get('infusionsoft::appName');
        $apiKey =  Config::get('infusionsoft::apiKey');
    }

    /**
     *
     *
     * @param string $permission Permission string.
     *
     * @return bool
     */
    public function can($permission, $requireAll = false)
    {
        if ($user = $this->user()) {
            return $user->can($permission, $requireAll);
        }
        return false;
    }
}