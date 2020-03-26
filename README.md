# Laravel Adminer

[Adminer](https://www.adminer.org) database management tool for your [Laravel](https://laravel.com) application.

---

## Contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)
- [Available plugins](#plugins)
- [Troubleshooting](#troubleshooting)
- [License](#license)

---

## Introduction

This package is a wrapper around [Adminer](https://www.adminer.org), it makes [Adminer](https://www.adminer.org) easy to setup, configure, customize and use within your [Laravel](https://laravel.com) application.

- [Adminer](https://www.adminer.org) version 4.7.6.
- [Adminer](https://www.adminer.org) plugins are easily enabled or disabled.
- Alternative designs shipped with this package, [take a look at available designs](https://github.com/vrana/adminer/tree/master/designs).
- Also supports custom designs, you may place your style file in the `public` directory and reference it in the `laravel-adminer` config file.
- [Adminer](https://www.adminer.org) localizations.
- No `VerifyCsrfToken` middleware file modification is required.

---

## Installation

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

---

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

3. Finally, a list of plugins is available in the `plugins` section, the list is not yet complete with all available [Adminer plugins](https://www.adminer.org/en/plugins/).

---

## Available plugins

| Name | Notes |
| ------ | ----------- |
| dump-alter   | Exports one database (e.g. development) so that it can be synced with other database (e.g. production). |
| dump-bz2 | Dump to Bzip2 format. |
| dump-date | Include current date and time in export filename. |
| dump-json | Dump to JSON format. |
| dump-xml | Dump to XML format in structure `<database name=""><table name=""><column name="">` value. |
| dump-zip | Dump to ZIP format. |
| edit-foreign | Select foreign key in edit form. |
| edit-textarea | Use `<textarea>` for char and varchar. |
| enum-option | Use `<select><option>` for enum edit instead of `<input type="radio">`. |
| enum-types | Use `<select><option>` for enum edit instead of regular input text on enum type in PostgreSQL. |
| foreign-system | Link system tables (in mysql and information_schema databases) by foreign keys. |
| frames | Allow using Adminer inside a frame (disables ClickJacking protection). |
| json-column | Display JSON values as table in edit. |
| tinymce | Edit all fields containing "_html" by HTML editor TinyMCE and display the HTML in select. |
| version-noverify | Disable version checker. |
| wymeditor | Edit all fields containing "_html" by HTML editor WYMeditor and display the HTML in select. |

---

## Troubleshooting

If you encounter a `TokenMismatchException`  when opening the page for the first time, or when taking an action after session has expired try `refreshing the page`.

---

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
