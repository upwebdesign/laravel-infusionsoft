<a href="https://packagist.org/packages/upwebdesign/laravel-infusionsoft"><img src="https://poser.pugx.org/upwebdesign/laravel-infusionsoft/downloads.svg?format=flat" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/upwebdesign/laravel-infusionsoft"><img src="https://poser.pugx.org/upwebdesign/laravel-infusionsoft/v/stable.svg?format=flat" alt="Latest Stable Version"></a>

# Laravel 6 & 7 Laravel Infusionsoft

[Buy me a coffee](https://www.buymeacoffee.com/upwebdesign) :coffee:

This package eases the oAuth flow for authentication and helps with token management.

## New in ^4.1

Added ability to connect to multiple Infusionsoft accounts!

## Installation

Use composer to install this package:

```
composer require upwebdesign/laravel-infusionsoft
```

For Laravel 5.6+, this package uses service provider and alias auto discovery. You can still add the service provider and alias below in `config/app.php`.

```
Upwebdesign\Infusionsoft\InfusionsoftServiceProvider::class,
```

in the `providers` array and optionally

```
'Infusionsoft' => Upwebdesign\Infusionsoft\InfusionsoftFacade::class,
```

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

To allow for multiple connected accounts, your .env will need these additional arguments. The first signifies there will be multiple connected Infusionsoft accounts, the second is a JSON encoded and escaped string with your API credentials. The array has identifying keys that will be explained later when making API calls.

```
INFUSIONSOFT_MULTI=true
INFUSIONSOFT_ACCOUNTS='[{\"account1\": {\"client_id\": \"\",\"client_secret\": \"\",\"redirect_uri\": \"\/infusionsoft\/account1\/auth\/callback\"}},{\"account2\": {\"client_id\": \"\",\"client_secret\": \"\",\"redirect_uri\": \"\/infusionsoft\/account2\/auth\/callback\"}}]'
```

## Credentials

Once you have all the necessary authorization information entered in your `.env` we can begin the authorization process.

You may access the route `/infusionsoft/auth` to begin the authorization process. This route will generate the necessary authorization URL to infusionsoft and redirect you to your Infusionsoft application. You must log into Infusionsoft and authorize your app to use the Infusionsoft API. Once you `allow`, you will be redirected back to your application `/infusionsoft/auth/callback`. Here you will either receive an exception or a successful message.

When using multiple connected accounts, your authorization URLs will change with your identifying keys. For example, `/infusionsoft/account1/auth` and `/infusionsoft/account1/auth/callback` for each respective account you want to connect.

## Redirect URI

INFUSIONSOFT_REDIRECT_URI if used, will override the callback from Infusionsoft and will result in the `infusionsoft.token` to not get created. This means you will need to handle the authorization code returned back from Infusionsoft to request an access token.

For multiple account connections, the redirect URI needs to follow this pattern:

```
/infusionsoft/{account1}/auth
/infusionsoft/{account1}/auth/callback
```

## Token Name & Cache

Token name default is `infusionsoft.token`, but can be overridden by INFUSIONSOFT_TOKEN_NAME. By default the cache store is set to `local`, but can be any cache store you have set up in your application and can be overridden by INFUSIONSOFT_CACHE. The default cache store is `file`, but can be any cache store you have set up.

For multiple account connections, the account keys will be appended to the `infusionsoft.token` name, for example:

```
infusionsoft.token.account1
```

## Refresh Access Tokens

While this package helps with keeping access tokens refreshed using refresh tokens, there may be instances where this is not best practice. For example, in an environment where the application is load balanced between two or more servers. It is entirely possible during the refresh action, one call could use an expired or invalid access token. To remedy this, a scheduled command is preferred.

```shell
php artisan infusionsoft::token-refresh
```

Since Infusionsoft access tokens expire after 24 hours it is recommended to refresh the access tokens twice a day. A command is already registered to be used by your application. However, you will need to schedule it in your `Console/Kernel.php` file.

```php
$schedule->command('infusionsoft:token-refresh')->twiceDaily(5, 17);
```

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

> :warning: For multiple account connections, the `InfusionsoftFacade` will not longer work.

You must invoke the class directly:

```php
$inf = new \Upwebdesign\Infusionsoft\Infusionsoft('account1');
```

[Buy me a coffee](https://www.buymeacoffee.com/upwebdesign) :coffee:

## License

Upwebdesign/Infusionsoft & Infusionsoft SDK is free software distributed under the terms of the MIT license.
