<?php

namespace Moharrum\LaravelAdminer\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Laravel adminer package service provider.
 *
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class LaravelAdminerServiceProvider extends ServiceProvider
{
    /**
     * The package namespace for generating URLs to actions.
     *
     * @var string
     */
    protected $packageNamespace = 'Moharrum\LaravelAdminer\Http\Controllers';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('laravel-adminer.php'),
        ], 'laravel-adminer-config');

        $this->publishes([
            __DIR__ . '/../../assets' => public_path('vendor/laravel-adminer'),
        ], 'laravel-adminer-assets');

        $this->bindRoutesAutomatically();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php',
            'laravel-adminer'
        );
    }

    /**
     * Bind routes automatically if this option is enabled in the configuration file.
     *
     * @return void
     */
    protected function bindRoutesAutomatically(): void
    {
        $this->bindManagerRoutes();

        $this->bindEditorRoutes();
    }

    /**
     * Binds manager routes.
     *
     * @return void
     */
    protected function bindManagerRoutes(): void
    {
        if (config('laravel-adminer.manager.enabled')) {
            Route::middleware(config('laravel-adminer.manager.route.middleware'))
                ->namespace($this->packageNamespace)
                ->prefix(config('laravel-adminer.manager.route.path'))
                ->group(function () {
                    Route::any('/', [
                        'as' => config('laravel-adminer.manager.route.name'),
                        'uses' => 'AdminerController@manager',
                    ]);
                });
        }
    }

    /**
     * Binds editor routes.
     *
     * @return void
     */
    protected function bindEditorRoutes(): void
    {
        if (config('laravel-adminer.editor.enabled')) {
            Route::middleware(config('laravel-adminer.editor.route.middleware'))
                ->namespace($this->packageNamespace)
                ->prefix(config('laravel-adminer.editor.route.path'))
                ->group(function () {
                    Route::any('/', [
                        'as' => config('laravel-adminer.editor.route.name'),
                        'uses' => 'AdminerController@editor',
                    ]);
                });
        }
    }
}
