<?php

namespace Hexatex\LaravelService;

use Illuminate\Support\ServiceProvider;

class LaravelServiceServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'hexatex');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'hexatex');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        // if ($this->app->runningInConsole()) {
        //     $this->bootForConsole();
        // }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        // $this->mergeConfigFrom(__DIR__.'/../config/laravel-service.php', 'laravel-service');

        // // Register the service the package provides.
        // $this->app->singleton('laravel-service', function ($app) {
        //     return new LaravelService;
        // });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        // $this->publishes([
        //     __DIR__.'/../config/laravel-service.php' => config_path('laravel-service.php'),
        // ], 'laravel-service.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/hexatex'),
        ], 'laravel-service.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/hexatex'),
        ], 'laravel-service.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/hexatex'),
        ], 'laravel-service.lang');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
