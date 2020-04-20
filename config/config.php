<?php

/*
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Application defaults
    |--------------------------------------------------------------------------
    |
    | Here you may specify the name of your application.
    |
    */

    'application_defaults' => [
        'name' => [
            'use_env_default' => false,

            'custom' => 'Laravel Adminer',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Adminer configuration
    |--------------------------------------------------------------------------
    |
    | These set of options controls the status of Adminer route
    | registration and default style settings.
    |
    */

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

    /*
    |--------------------------------------------------------------------------
    | Adminer Editor configuration
    |--------------------------------------------------------------------------
    |
    | These set of options controls the status of Adminer Editor route
    | registration, connection parameters and default style settings.
    |
    */

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

    /*
    |--------------------------------------------------------------------------
    | Plugins
    |--------------------------------------------------------------------------
    |
    | Plugins are used to extend Adminer and Adminer Editor,
    | @see https://www.adminer.org/plugins
    |
    */

    'plugins' => [
        'database-hide' => [
            // Hide some databases from the interface - just to improve design, not a security plugin.
            'enabled' => false,
            'params' => [
                // array, case insensitive database names in values.
                'databases' => [],
            ],
        ],
        'designs' => [
            // Allow switching designs.
            'enabled' => false,
            'params' => [
                // string, path to the directory containing styles.
                'designs_path' => 'vendor/laravel-adminer/styles',
            ],
        ],
        'dump-alter' => [
            // Exports one database (e.g. development) so that it can be synced with other database (e.g. production).
            'enabled' => false,
        ],
        'dump-bz2' => [
            // Dump to Bzip2 format.
            'enabled' => true,
        ],
        'dump-date' => [
            // Include current date and time in export filename.
            'enabled' => true,
        ],
        'dump-json' => [
            // Dump to JSON format.
            'enabled' => false,
        ],
        'dump-xml' => [
            // Dump to XML format in structure <database name=""><table name=""><column name="">value.
            'enabled' => false,
        ],
        'dump-zip' => [
            // Dump to ZIP format.
            'enabled' => true,
        ],
        'edit-foreign' => [
            // Select foreign key in edit form.
            'enabled' => true,
            'params' => [
                'limit' => 0,
            ],
        ],
        'edit-textarea' => [
            // Use <textarea> for char and varchar.
            'enabled' => false,
        ],
        'enum-option' => [
            // Use <select><option> for enum edit instead of <input type="radio">.
            'enabled' => false,
        ],
        'enum-types' => [
            // Use <select><option> for enum edit instead of regular input text on enum type in PostgreSQL.
            'enabled' => false,
        ],
        'foreign-system' => [
            // Link system tables (in mysql and information_schema databases) by foreign keys.
            'enabled' => false,
        ],
        'frames' => [
            // Allow using Adminer inside a frame (disables ClickJacking protection).
            'enabled' => false,
            'params' => [
                // boolean, allow running from the same origin only.
                'same_origin' => false,
            ],
        ],
        'json-column' => [
            // Display JSON values as table in edit.
            'enabled' => true,
        ],
        'slugify' => [
            // Prefill field containing "_slug" with slugified value of a previous field (JavaScript).
            'enabled' => false,
            // function __construct($from = 'áčďéěíňóřšťúůýž', $to = 'acdeeinorstuuyz')
            'params' => [
                // string, find these characters...
                'from' => null, // Leave null to use plugin defaults.
                // string, ...and replace them by these
                'to' => null, // Leave null to use plugin defaults.
            ],
        ],
        'sql-log' => [
            // Log all queries to SQL file.
            // Files are stored in storage_path('adminer') / {$database_name}.sql
            'enabled' => true,
            'params' => [
                // string, defaults to "$database.sql".
                'filename' => '',
            ],
        ],
        'struct-comments' => [
            // Show comments of sql structure in more places (mainly where you edit things).
            'enabled' => true,
        ],
        'tables-filter' => [
            // Filter names in tables list.
            'enabled' => false,
        ],
        'tinymce' => [
            // Edit all fields containing "_html" by HTML editor TinyMCE and display the HTML in select.
            'enabled' => false,
            'params' => [
                // string, path to include tinymce js files.
                'path' => 'https://example.com/plugins/tinymce/tiny_mce.min.js',
                // Or, see https://www.tiny.cloud/get-tiny/
                // 'path' => 'https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js',
            ],
        ],
        'translation' => [
            // Translate all table and field comments, enum and set values from the translation table (automatically inserts new translations).
            'enabled' => false,
        ],
        'version-noverify' => [
            // Disable version checker.
            'enabled' => true,
        ],
        'wymeditor' => [
            // Edit all fields containing "_html" by HTML editor WYMeditor and display the HTML in select.
            'enabled' => false,
            'params' => [
                // array, path to include jQuery and wmyeditor js files.
                'scripts' => [
                    'https://example.com/plugins/jquery/jquery.min.js',
                    'https://example.com/plugins/wymeditor/jquery.wymeditor.min.js',
                ],
                // string, wmyeditor custom options
                // in format "skin: 'custom', preInit: function () { }"
                // see http://www.wymeditor.org
                'options' => '',
            ],
        ],
    ],

];
