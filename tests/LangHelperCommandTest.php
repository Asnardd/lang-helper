<?php

namespace Asnardd\LangHelper\Tests;

use Asnardd\LangHelper\LangHelperServiceProvider;
use Orchestra\Testbench\TestCase;

class LangHelperCommandTest extends TestCase
{
    /** @test */
    public function display_help(): void
    {
        $this->artisan('help make:lang')
            ->assertSuccessful();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LangHelperServiceProvider::class,
        ];
    }
}