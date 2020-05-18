<h1 align="center">
    <br>
    <img src="docs/logo.png" alt="Laravel Adminer" width="200">
    <br>
    <br>
    Laravel Adminer
    <br>
</h1>

<h4 align="center"><a href="https://www.adminer.org" target="_blank">Adminer</a> database management tool for your <a href="https://laravel.com" target="_blank">Laravel</a> application.</h4>

<p align="center">
    <img alt="GitHub tag (latest SemVer)" src="https://img.shields.io/github/v/tag/moharrum/laravel-adminer?label=Stable%20release&style=flat-square">
    <img alt="GitHub" src="https://img.shields.io/github/license/moharrum/laravel-adminer?style=flat-square">
</p>

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [CSRF token middleware](#csrf-token-middleware)
- [Usage](#usage)
- [Available plugins](#available-plugins)
- [Available designs](#available-designs)
- [License](#license)

## Introduction

> What is Adminer?

Adminer (formerly phpMinAdmin) is a full-featured database management tool written in PHP. For more information [visit Adminer website](https://www.adminer.org). Adminer is available for MySQL, MariaDB, PostgreSQL, SQLite, MS SQL, Oracle, Firebird, SimpleDB, Elasticsearch and MongoDB.

> What is Laravel Adminer?

This package is a wrapper around [Adminer](https://www.adminer.org), it makes [Adminer](https://www.adminer.org) easy to setup, configure, customize and use within your [Laravel](https://laravel.com) application.

## Features

- Current [Adminer](https://www.adminer.org) version used is: `4.7.7`.
- Supports both [Adminer](https://www.adminer.org) and [Adminer Editor](https://www.adminer.org/editor).
- Plugins are integrated easily.
- Alternative designs shipped with this package.
- Custom designs are also supported and can be added easily.
- No `VerifyCsrfToken` middleware file modification is required.

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

Finally, publish the configuration file:

```php
php artisan vendor:publish --provider="Moharrum\LaravelAdminer\Providers\LaravelAdminerServiceProvider"
```

## CSRF token middleware

If you encounter a `TokenMismatchException`  when opening the page for the first time, or when taking an action after session has expired `refresh the page`.

## Usage

- **Application name**

    You may specify if you want Laravel Adminer to display application name from `.env` file or a custom value:

```php
'application_defaults' => [
    'name' => [
        'use_env_default' => false,

        'custom' => 'Laravel Adminer',
    ],
],
```

- **Adminer Manager**

    `enabled` is used to enable or disable automatic route registration, if you wish to register your routes manually, set `enabled` to `false`. Additionally, you must specify route `name` and `path` in the `route` section. Optionally, you may specify an alternative design in the `style` section.

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

- **Adminer Editor**

    > Adminer Editor is both easy-to-use and user-friendly database data editing tool written in PHP. It is suitable for common users, as it provides high-level data manipulation.

```php
'editor' => [
    'enabled' => false,

    'parameters' => [
        'connection' => env('DB_CONNECTION', null),
        'database' => env('DB_DATABASE', null),
        'host' => env('DB_HOST', null),
        'port' => env('DB_PORT', null),
    ],

    'route' => [
        'name' => 'adminer.editor.index',
        'path' => 'adminer/editor',

        'middleware' => [
            'web',
        ],
    ],

    'style' => 'vendor/laravel-adminer/styles/pepa-linha/adminer.css',
],
```

- **Plugins**

    A list of plugins is available in the `plugins` section, the list is not yet complete with all [Adminer plugins](https://www.adminer.org/en/plugins/).

## Available plugins

- **database-hide**
    Hide some databases from the interface - just to improve design, not a security plugin.

- **designs**
    Allow switching designs.

- **dump-alter**
    Exports one database (e.g. development) so that it can be synced with other database (e.g. production).

- **dump-bz2**
    Dump to Bzip2 format.

- **dump-date**
    Include current date and time in export filename.

- **dump-json**
    Dump to JSON format.

- **dump-xml**
    Dump to XML format in structure `<database name=""><table name=""><column name="">` value.

- **dump-zip**
    Dump to ZIP format.

- **edit-foreign**
    Select foreign key in edit form.

- **edit-textarea**
    Use `<textarea>` for char and varchar.

- **enum-option**
    Use `<select><option>` for enum edit instead of `<input type="radio">`.

- **enum-types**
    Use `<select><option>` for enum edit instead of regular input text on enum type in PostgreSQL.

- **foreign-system**
    Link system tables (in mysql and information_schema databases) by foreign keys.

- **frames**
    Allow using Adminer inside a frame (disables ClickJacking protection).

- **json-column**
    Display JSON values as table in edit.

- **slugify**
    Prefill field containing `_slug` with slugified value of a previous field (JavaScript).

- **sql-log**
    Log all queries to SQL file.

- **struct-comments**
    Show comments of sql structure in more places (mainly where you edit things).

- **tables-filter**
    Filter names in tables list.

- **tinymce**
    Edit all fields containing `_html` by HTML editor TinyMCE and display the HTML in select.

- **translation**
    Translate all table and field comments, enum and set values from the translation table (automatically inserts new translations).

- **version-noverify**
    Disable version checker.

- **wymeditor**
    Edit all fields containing `_html` by HTML editor WYMeditor and display the HTML in select.

## Available designs

To view all designs with screenshots [click here](docs/DESIGNS.md).

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
