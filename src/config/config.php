<?php
/**
 * This file is part of Infusionsoft,
 *
 * @license MIT
 * @package Upwebdesign\Infusionsoft
 */
return array(
    /*
    |--------------------------------------------------------------------------
    | The name of your Infusionsoft application
    |--------------------------------------------------------------------------
    |
    | You may log into Infusionsoft to obtain your application name.
    |
    */
    'client_id' => env('INFUSIONSOFT_ID'),
    /*
    |--------------------------------------------------------------------------
    | Your API Key, obtained from Infusionsoft
    |--------------------------------------------------------------------------
    |
    | You may log into Infusionsoft to retreive this key.
    |
    */
    'client_secret' => env('INFUSIONSOFT_SECRET'),
    /*
    |--------------------------------------------------------------------------
    | Your API Key, obtained from Infusionsoft
    |--------------------------------------------------------------------------
    |
    | You may log into Infusionsoft to retreive this key.
    |
    */
    'auth_code' => env('INFUSIONSOFT_AUTHORIZATION_CODE'),
    /*
    |--------------------------------------------------------------------------
    | Your API Key, obtained from Infusionsoft
    |--------------------------------------------------------------------------
    |
    | You may log into Infusionsoft to retreive this key.
    |
    */
    'redirect_uri' => env('INFUSIONSOFT_REDIRECT_URI')
);