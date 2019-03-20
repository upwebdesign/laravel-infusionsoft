<?php

namespace Upwebdesign\Infusionsoft;

/**
 * This file is part of Infusionsoft
 *
 * @license MIT
 * @package Upwebdesign\Infusionsoft
 */

use Illuminate\Support\Facades\Facade;

class InfusionsoftFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'infusionsoft';
    }
}