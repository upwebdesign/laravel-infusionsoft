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
    | Infusionsoft Debugging
    |--------------------------------------------------------------------------
    |
    | Turn on debugging for Infusionsoft calls
    |
    */
    'debug' => false,

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
    'token_name' => env('INFUSIONSOFT_TOKEN_NAME', 'infusionsoft.token'),

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | The caching system used to store the access and refresh token received
    | from Infusionsoft
    |
    */
    'cache' => env('INFUSIONSOFT_CACHE', 'local'),

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
    'client_id' => env('INFUSIONSOFT_CLIENT_ID'),

    /*
    |--------------------------------------------------------------------------
    | Infusionsoft Client Secret
    |--------------------------------------------------------------------------
    |
    | If you do not have a client secret, you need to get one at:
    | http://developer.infusionsoft.com
    |
    */
    'client_secret' => env('INFUSIONSOFT_CLIENT_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Infusionsoft redirect URI
    |--------------------------------------------------------------------------
    |
    | This is the callback URL that Infusionsoft will redirect the users back
    | to after authorization.
    |
    */
    'redirect_uri' => env('INFUSIONSOFT_REDIRECT_URI', 'infusionsoft/auth/callback')
);
