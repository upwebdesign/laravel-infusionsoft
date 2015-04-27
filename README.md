# Laravel/Infusionsoft (Laravel 5 Package)

Laravel 5 Port of the Infusionsoft SDK

## Installation

In order to install Laravel 5 Infusionsoft, just add

    "infusionsoft/php-sdk": "dev-master",
    "upwebdesign/laravel-infusionsoft": "dev-master"

to your composer.json. Then run `composer install` or `composer update`.

Then in your `config/app.php` add

    'Upwebdesign\Infusionsoft\InfusionsoftServiceProvider',

in the providers array and

    'Infusionsoft' => 'Upwebdesign\Infusionsoft\InfusionsoftFacade',

to the `aliases` array.

Since this is not a Packagist Package (Yet) add this repository to your composer.json file

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/upwebdesign/laravel-infusionsoft"
        }
    ]

## Configuration

Just use `php artisan vendor:publish` and a `infusionsoft.php` file will be created in your app/config directory.

This package uses .env to store your Infusionsoft app name and API key.

## License

Upwebdesign/Infusionsoft & Infusionsoft SDK is free software distributed under the terms of the MIT license.