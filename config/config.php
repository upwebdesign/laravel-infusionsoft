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
    | Infusionsoft Token File Name
    |--------------------------------------------------------------------------
    |
    | The token is stored in local storage when initially authorizing your
    | application. This is the name of the token file and can be renamed
    | to your liking.
    |
    */
    'token_name' => 'infusionsoft.token',
    /*
    |--------------------------------------------------------------------------
    | Infusionsoft Debugging
    |--------------------------------------------------------------------------
    |
    | Turn on debugging for Infusionsoft calls
    |
    */
    'debug' => false,
    /*
    |--------------------------------------------------------------------------
    | Infusionsoft User ID
    |--------------------------------------------------------------------------
    |
    | This user id is used to run saved searches through the API
    |
    */
    'user_id' => env('INFUSIONSOFT_USER_ID'),
    /*
    |--------------------------------------------------------------------------
    | Infusionsoft Client ID
    |--------------------------------------------------------------------------
    |
    | If you do not have a client ID, you need to get one at:
    | http://developer.infusionsoft.com
    |
    */
    'client_id' => env('INFUSIONSOFT_ID'),
    /*
    |--------------------------------------------------------------------------
    | Infusionsoft Client Secret
    |--------------------------------------------------------------------------
    |
    | If you do not have a client secret, you need to get one at:
    | http://developer.infusionsoft.com
    |
    */
    'client_secret' => env('INFUSIONSOFT_SECRET'),
    /*
    |--------------------------------------------------------------------------
    | Infusionsoft Authorization Code
    |--------------------------------------------------------------------------
    |
    | Your authorization code you receive when authorizing your application
    |
    */
    'auth_code' => env('INFUSIONSOFT_AUTHORIZATION_CODE'),
    /*
    |--------------------------------------------------------------------------
    | Infusionsoft Redirect URI
    |--------------------------------------------------------------------------
    |
    | This is the redirect URL Infusionsoft will use to inform you of
    | your authorization code.
    |
    */
    'redirect_uri' => env('INFUSIONSOFT_REDIRECT_URI'),
    /*
    |--------------------------------------------------------------------------
    | Infusionsoft Tagging
    |--------------------------------------------------------------------------
    |
    | Define your tags in Infusionsoft
    |
    */
    'tags' => [],

);