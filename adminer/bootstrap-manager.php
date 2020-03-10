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

    $plugins = array();

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

    class LaravelAdminer extends AdminerPlugin {
        /**
         * Name in title and navigation
         *
    	 * @return string HTML code
    	 */
		function name() {
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
    	function css() {
            $return = array();

            $shouldLoadCustomStyle = (bool)config('laravel-adminer.manager.style');

            if ($shouldLoadCustomStyle && file_exists(public_path(config('laravel-adminer.manager.style')))) {
                $return[] = "/" . config('laravel-adminer.manager.style') . "?v=" . crc32(file_get_contents(public_path(config('laravel-adminer.manager.style'))));
            }

    		return $return;
    	}
	}

    return new LaravelAdminer($plugins);
}

// include original Adminer
include __DIR__ . DIRECTORY_SEPARATOR . 'manager' . DIRECTORY_SEPARATOR . 'adminer-4.7.6.php';
