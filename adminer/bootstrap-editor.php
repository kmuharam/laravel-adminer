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

    // $class = "AdminerTranslation";

    $plugins = array(
        // specify enabled plugins here
        // new AdminerDumpXml,
        // new AdminerTinymce,
        // new AdminerFileUpload("data/"),
        // new AdminerSlugify,
        // new $class,
        // new AdminerForeignSystem,
    );

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

            return "<a href='" . route(config('laravel-adminer.editor.route.name')) . "' id='h1'>" . e($name) . "</a>";
		}

        /**
         * Get URLs of the CSS files
         *
    	 * @return array of strings
    	 */
    	function css() {
            $return = array();

    		return $return;
    	}

        function database() {
            $database = config('database.connections.' . $connection . '.database');

            return $database;
        }

        /**
         * Print login form
         *
    	 * @return null
    	 */
         function loginForm() {
     		echo "<table cellspacing='0' class='layout'>\n";

            $connection = config('database.default');
            $database = config('database.connections.' . $connection . '.database');
            $server = config('database.connections.' . $connection . '.host');
            $port = config('database.connections.' . $connection . '.port');


     		echo $this->loginFormField('username', '<tr><th>' . lang('Username') . '<td>', '<input type="hidden" name="auth[driver]" value="' . $connection . '"><input type="hidden" name="auth[db]" value="' . $database . '"><input type="hidden" name="auth[server]" value="' . $server . ':' . $port . '"><input name="auth[username]" id="username" value="' . h($_GET["username"]) . '" autocomplete="username" autocapitalize="off">' . script("focus(qs('#username')); qs('#username').form['auth[driver]'].onchange();"));
     		echo $this->loginFormField('password', '<tr><th>' . lang('Password') . '<td>', '<input type="password" name="auth[password]" autocomplete="current-password">' . "\n");
     		echo "</table>\n";
     		echo "<p><input type='submit' value='" . lang('Login') . "'>\n";
     		echo checkbox("auth[permanent]", 1, $_COOKIE["adminer_permanent"], lang('Permanent login')) . "\n";
     	}
	}

    return new LaravelAdminer($plugins);
}

// include original Adminer
include __DIR__ . DIRECTORY_SEPARATOR . 'editor' . DIRECTORY_SEPARATOR . 'editor-4.7.6.php';
