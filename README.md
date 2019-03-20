# Laravel/Infusionsoft (Laravel 5 Package)

Laravel 5 Port of the Infusionsoft PHP SDK

## Installation

In order to install Laravel 5 Infusionsoft, just add

    composer require upwebdesign/laravel-infusionsoft

Then in your `config/app.php` add the provider

    Upwebdesign\Infusionsoft\InfusionsoftServiceProvider::class,

in the providers array and optionally

    'Infusionsoft' => Upwebdesign\Infusionsoft\InfusionsoftFacade::class,

to the `aliases` array.

## Configuration

Just use `php artisan vendor:publish` and a `infusionsoft.php` file will be created in your app/config directory.

## Environment

Fill in your Client ID and Secret along with the redirect URI

```
INFUSIONSOFT_ID=
INFUSIONSOFT_SECRET=
INFUSIONSOFT_AUTHORIZATION_CODE=
INFUSIONSOFT_REDIRECT_URI=
```

Once you have all the necessary authorization information entered in your `.env` we can begin the authorization process.

When making your first call to Infusionsoft, you will be presented with an exception which contains your authorization URL. Visit that URL, login and authorize your app. The resulting URL will contain your `Authorization Code`. Copy and paste the code in your `INFUSIONSOFT_AUTHORIZATION_CODE` environment definition.

## Notes

The Infusionsoft token is stored locally in your storage folder, depending on how you set your filesystems.php configuration.

### Lumen

Register the service provider

```php
$app->register(Upwebdesign\Infusionsoft\InfusionsoftLumenServiceProvider::class);
```

Add the ability to read the `infusionsoft` config file

Add our configuration `bootstrap/app.php`

```php
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