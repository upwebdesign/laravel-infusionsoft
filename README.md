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

## Notes

The Infusionsoft token is stored locally in your storage folder, depending on how you set your filesystems.php configuration.

## License

Upwebdesign/Infusionsoft & Infusionsoft SDK is free software distributed under the terms of the MIT license.