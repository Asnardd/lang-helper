<?php

namespace Asnardd\LangHelper;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Asnardd\LangHelper\Commands\LangHelperCommand;

class LangHelperServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('lang-helper')
            ->hasConfigFile()
            ->hasCommand(LangHelperCommand::class);
    }
}
