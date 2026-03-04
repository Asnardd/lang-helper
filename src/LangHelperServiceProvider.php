<?php

namespace Asnardd\LangHelper;

use Asnardd\LangHelper\Commands\LangHelperCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
