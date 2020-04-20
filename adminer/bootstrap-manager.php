<?php

function adminer_object()
{
    $pluginsPath = __DIR__ . DIRECTORY_SEPARATOR . 'plugins';

    // required to run any plugin
    include_once $pluginsPath . DIRECTORY_SEPARATOR . 'plugin.php';

    // autoloader
    foreach (glob($pluginsPath . DIRECTORY_SEPARATOR . '*.php') as $filename) {
        include_once "{$filename}";
    }

    $plugins = [];

    if (config('laravel-adminer.plugins.database-hide.enabled')) {
        $databases = config('laravel-adminer.plugins.database-hide.params.databases');

        $plugins[] = new AdminerDatabaseHide($databases);
    }

    if (config('laravel-adminer.plugins.designs.enabled')) {
        $directory = public_path(config('laravel-adminer.plugins.designs.params.designs_path'));

        $scannedDirectory = array_diff(scandir($directory), ['..', '.']);

        $designs = [];

        foreach ($scannedDirectory as $scan) {
            $pathToDirectory = public_path(config('laravel-adminer.plugins.designs.params.designs_path'));
            $pathToDirectory .= DIRECTORY_SEPARATOR . $scan;

            if (is_dir($pathToDirectory)) {
                $url = config('laravel-adminer.plugins.designs.params.designs_path');
                $url .= DIRECTORY_SEPARATOR . $scan . DIRECTORY_SEPARATOR . 'adminer.css';

                $designs[asset($url)] = $scan;
            }
        }

        $plugins[] = new AdminerDesigns($designs);
    }

    if (config('laravel-adminer.plugins.dump-alter.enabled')) {
        $plugins[] = new AdminerDumpAlter();
    }

    if (config('laravel-adminer.plugins.dump-bz2.enabled')) {
        $plugins[] = new AdminerDumpBz2();
    }

    if (config('laravel-adminer.plugins.dump-date.enabled')) {
        $plugins[] = new AdminerDumpDate();
    }

    if (config('laravel-adminer.plugins.dump-json.enabled')) {
        $plugins[] = new AdminerDumpJson();
    }

    if (config('laravel-adminer.plugins.dump-xml.enabled')) {
        $plugins[] = new AdminerDumpXml();
    }

    if (config('laravel-adminer.plugins.dump-zip.enabled')) {
        $plugins[] = new AdminerDumpZip();
    }

    if (config('laravel-adminer.plugins.edit-foreign.enabled')) {
        $limit = config('laravel-adminer.plugins.edit-foreign.params.limit');

        $plugins[] = new AdminerEditForeign($limit);
    }

    if (config('laravel-adminer.plugins.edit-textarea.enabled')) {
        $plugins[] = new AdminerEditTextarea();
    }

    if (config('laravel-adminer.plugins.enum-option.enabled')) {
        $plugins[] = new AdminerEnumOption();
    }

    if (config('laravel-adminer.plugins.enum-types.enabled')) {
        $plugins[] = new AdminerEnumTypes();
    }

    if (config('laravel-adminer.plugins.foreign-system.enabled')) {
        $plugins[] = new AdminerForeignSystem();
    }

    if (config('laravel-adminer.plugins.frames.enabled')) {
        $sameOrigin = config('laravel-adminer.plugins.frames.params.same_origin');

        $plugins[] = new AdminerFrames($sameOrigin);
    }

    if (config('laravel-adminer.plugins.json-column.enabled')) {
        $plugins[] = new AdminerJsonColumn();
    }

    if (config('laravel-adminer.plugins.slugify.enabled')) {
        $from = config('laravel-adminer.plugins.slugify.params.from');
        $to = config('laravel-adminer.plugins.slugify.params.to');

        if (! empty($from) && ! empty($to)) {
            $plugins[] = new AdminerSlugify($from, $to);
        } else {
            $plugins[] = new AdminerSlugify();
        }
    }

    if (config('laravel-adminer.plugins.sql-log.enabled')) {
        $filename = config('laravel-adminer.plugins.sql-log.params.filename');

        $plugins[] = new AdminerSqlLog($filename);
    }

    if (config('laravel-adminer.plugins.struct-comments.enabled')) {
        $plugins[] = new AdminerStructComments();
    }

    if (config('laravel-adminer.plugins.tables-filter.enabled')) {
        $plugins[] = new AdminerTablesFilter();
    }

    if (config('laravel-adminer.plugins.tinymce.enabled')) {
        $path = config('laravel-adminer.plugins.tinymce.params.path');

        $plugins[] = new AdminerTinymce($path);
    }

    if (config('laravel-adminer.plugins.translation.enabled')) {
        $plugins[] = new AdminerTranslation();
    }

    if (config('laravel-adminer.plugins.version-noverify.enabled')) {
        $plugins[] = new AdminerVersionNoverify();
    }

    if (config('laravel-adminer.plugins.wymeditor.enabled')) {
        $scripts = config('laravel-adminer.plugins.wymeditor.params.scripts');
        $options = config('laravel-adminer.plugins.wymeditor.params.options');

        $plugins[] = new AdminerWymeditor($scripts, $options);
    }

    class LaravelAdminer extends AdminerPlugin
    {
        /**
         * Name in title and navigation
         *
    	 * @return string HTML code
    	 */
        public function name()
        {
            $name = config('laravel-adminer.application_defaults.name.use_env_default') ?
            config('app.name')
            : config('laravel-adminer.application_defaults.name.custom');

            return "<a href='" . route(config('laravel-adminer.manager.route.name')) . "' id='h1'>" . e($name) . "</a>";
        }

        /**
         * Get URLs of the CSS files
         *
    	 * @return array of strings
    	 */
        public function css()
        {
            $return = array();

            $shouldLoadCustomStyle = (bool)config('laravel-adminer.manager.style');

            if ($shouldLoadCustomStyle && file_exists(public_path(config('laravel-adminer.manager.style')))) {
                $return[] = "/" . config('laravel-adminer.manager.style') . "?v=" . crc32(file_get_contents(public_path(config('laravel-adminer.manager.style'))));
            }

            return $return;
        }

        /**
         * Print login form.
         *
    	 * @return null
    	*/
        public function loginForm()
        {
            parent::loginForm();

            echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
        }
    }

    return new LaravelAdminer($plugins);
}

// include original Adminer
require __DIR__ . DIRECTORY_SEPARATOR . 'manager' . DIRECTORY_SEPARATOR . 'adminer-4.7.6.php';
