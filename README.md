# Laravel Adminer

[Adminer](https://www.adminer.org) database management tool for your [Laravel](https://laravel.com) application.

## Introduction

This package is a wrapper around [Adminer](https://www.adminer.org), it makes [Adminer](https://www.adminer.org) easy to setup, configure, customize and use withing your [Laravel](https://laravel.com) application.

* [Adminer](https://www.adminer.org) version 4.7.6.
* [Adminer](https://www.adminer.org) plugins are easily enabled or disabled.
* Alternative designs shipped with this package, [take a look at available designs](https://github.com/vrana/adminer/tree/master/designs).
* Also supports custom designs.
* [Adminer](https://www.adminer.org) localizations.
* No `VerifyCsrfToken` middleware file modification is required.

### Installing

Install the package via composer:

```bash
    composer require moharrum/laravel-adminer
```

Edit `config/app.php`, add package service provider (ignore this step if you have package discovery enabled):
```php
    'providers' => [
        Moharrum\LaravelAdminer\Providers\LaravelAdminerServiceProvider::class,
    ]
```

Finally, you must publish the configuration file:

```php
    php artisan vendor:publish --provider="Moharrum\LaravelAdminer\Providers\LaravelAdminerServiceProvider"
```

## Usage

Referring to the configuration file, we have three main sections.

1. Application name, in this section you may specify if you want [Adminer](https://www.adminer.org) to display application name from `.env` file or you may specify a custom value:

```php
    'application_defaults' => [
        'name' => [
            'use_env_default' => false,

            'custom' => 'Laravel Adminer',
        ],
    ],
```

2. Database manager section, `enabled` is used to enable or disable automatic route register, if you wish to register [Adminer](https://www.adminer.org) routes manually, set `enabled` to `false`. Additionally, you must specify both route `name` and `path` in the `route` section. Optionally, you may specify an alternative design in the `style` section.

```php
    'manager' => [
        'enabled' => true,

        'route' => [
            'name' => 'adminer.manager.index',
            'path' => 'adminer/manager',

            'middleware' => [
                'web',
            ],
        ],

        'style' => 'vendor/laravel-adminer/styles/pepa-linha/adminer.css',
    ],
```

3. Finally, a list of plugins is available in the `plugins` section, the list is not yet complete with all available [Adminer](https://www.adminer.org) plugins.

## TODO List

* Add more plugins.
* Enable [Adminer editor](https://www.adminer.org/editor) along side the database manager.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
