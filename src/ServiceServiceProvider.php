<?php

namespace Hexatex\LaravelService;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Hexatex\LaravelService\Commands\ServiceCommand;

class ServiceServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-service')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-service_table')
            ->hasCommand(ServiceCommand::class);
    }
}
