<?php

namespace Curia\Auth\Providers;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    public const CONFIG_PATH = __DIR__.'/../../config/auth.php';
    public const MIGRATIONS_PATH = __DIR__.'/../../database/migrations';
    public const LANGS_PATH = __DIR__.'/../../resources/lang';
    public const VIEWS_PATH = __DIR__.'/../../resources/views';
    public const ASSETS_PATH = __DIR__.'/../../resources/assets';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        if (file_exists(self::MIGRATIONS_PATH)) {
            $this->loadMigrationsFrom(self::MIGRATIONS_PATH);
        }

        if (file_exists(self::LANGS_PATH)) {
            $this->loadTranslationsFrom(self::LANGS_PATH, 'curia.auth');
        }

        if (file_exists(self::VIEWS_PATH)) {
            $this->loadViewsFrom(self::VIEWS_PATH, 'curia.auth');
        }

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        // Register config
        $this->mergeConfigFrom(self::CONFIG_PATH, 'curia.auth');

        // Register providers
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['curia.auth'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            self::CONFIG_PATH => config_path('curia.auth.php'),
        ], ['curia.auth', 'curia.auth.config']);

        // Publishing the views.
        /*$this->publishes([
            self::VIEWS_PATH => base_path('resources/views/vendor/curia/auth'),
        ], ['curia.auth', 'curia.auth.views']);*/

        // Publishing the translation files.
        /*$this->publishes([
            self::LANGS_PATH => resource_path('lang/vendor/curia/auth'),
        ], ['curia.auth', 'curia.auth.lang']);*/

        // Publishing assets.
        /*$this->publishes([
            self::ASSETS_PATH => public_path('vendor/curia/auth'),
        ], ['curia.auth', 'curia.auth.assets']);*/

        // Registering package commands.
        // $this->commands([]);
    }
}
