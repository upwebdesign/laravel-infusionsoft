<a href="https://packagist.org/packages/upwebdesign/laravel-infusionsoft"><img src="https://poser.pugx.org/upwebdesign/laravel-infusionsoft/downloads.svg?format=flat" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/upwebdesign/laravel-infusionsoft"><img src="https://poser.pugx.org/upwebdesign/laravel-infusionsoft/v/stable.svg?format=flat" alt="Latest Stable Version"></a>

# Laravel 6 & 7 Laravel Infusionsoft

This package eases the oAuth flow for authentication and helps with token management.

## Installation

Use composer to install this package:

    composer require upwebdesign/laravel-infusionsoft

For Laravel 5.6+, this package uses service provider and alias auto discovery. You can still add the service provider and alias below in `config/app.php`.

    Upwebdesign\Infusionsoft\InfusionsoftServiceProvider::class,

in the `providers` array and optionally

    'Infusionsoft' => Upwebdesign\Infusionsoft\InfusionsoftFacade::class,

to the `aliases` array.

## Configuration

Publish `infusionsoft.php` config file.

```shell
php artisan vendor:publish --provider="Upwebdesign\Infusionsoft\InfusionsoftServiceProvider" --tag="config"
```

## Environment

Fill in your Client ID and Secret along with the redirect URI and cache store. Default values are used below.

```
INFUSIONSOFT_CLIENT_ID=
INFUSIONSOFT_CLIENT_SECRET=
INFUSIONSOFT_CACHE=file
INFUSIONSOFT_REDIRECT_URI="/infusionsoft/auth/callback"
```

## Credentials

Once you have all the necessary authorization information entered in your `.env` we can begin the authorization process.

You may access the route `/infusionsoft/auth` to begin the authorization process. This route will generate the necessary authorization URL to infusionsoft and redirect you to your Infusionsoft application. You must log into Infusionsoft and authorize your app to use the Infusionsoft API. Once you `allow`, you will be redirected back to your application `/infusionsoft/auth/callback`. Here you will either receive an exception or a successful message.

## Redirect URI

INFUSIONSOFT_REDIRECT_URI if used, will override the callback from Infusionsoft and will result in the `infusionsoft.token` to not get created. This means you will need to handle the authorization code returned back from Infusionsoft to request an access token.

## Token Name & Cache

Token name default is `infusionsoft.token`, but can be overridden by INFUSIONSOFT_TOKEN_NAME. By default the cache store is set to `local`, but can be any cache store you have set up in your application and can be overridden by INFUSIONSOFT_CACHE. The default cache store is `file`, but can be any cache store you have set up.

# Lumen

Register the service provider

```php
$app->register(Upwebdesign\Infusionsoft\InfusionsoftLumenServiceProvider::class);
```

Add Infusionsoft configuration `bootstrap/app.php`

```php
// Add the ability to read the `infusionsoft` config file
$app->configure('infusionsoft');
```

Activate filesystems

`config/filesystems.php`

See a sample filesystems.php config file.
https://github.com/laravel/laravel/blob/master/config/filesystems.php

Add our configuration `bootstrap/app.php`
```php

... 

$app->configure('filesystems');

...

$app->singleton(
    Illuminate\Contracts\Filesystem\Factory::class,
    function ($app) {
        return new Illuminate\Filesystem\FilesystemManager($app);
    }
);
...
```

Add Infusionsoft facade (optional)

```php
class_alias(Upwebdesign\Infusionsoft\InfusionsoftFacade::class, 'Infusionsoft');
```

## License

Upwebdesign/Infusionsoft & Infusionsoft SDK is free software distributed under the terms of the MIT license.
