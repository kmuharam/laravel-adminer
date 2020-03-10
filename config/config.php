<?php

/*
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */

return [

    'application_defaults' => [
        'name' => [
            'use_env_default' => false,

            'custom' => 'Laravel Adminer',
        ],
    ],

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

    'plugins' => [
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
    ],

];
