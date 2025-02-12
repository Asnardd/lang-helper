<?php

namespace Asnardd\LangHelper\Tests;

use Asnardd\LangHelper\LangHelperServiceProvider;
use Orchestra\Testbench\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\File;


class LangHelperCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (!File::exists(base_path(config('lang-helper.lang-folder','lang')))) {
            File::makeDirectory(base_path(config('lang-helper.lang-folder','lang')), 0755, true);
        }
    }

    #[Test]
    public function it_display_help(): void
    {
        $this->artisan('help make:lang')
            ->assertSuccessful();
    }

    #[Test]
    public function it_creates_a_new_translation_file_and_directory(): void
    {
        $filePath = base_path(config('lang-helper.lang-folder', 'lang') . '/fr/users.php');

        $this->artisan('make:lang', ['name' => 'users', 'lang' => 'fr'])
            ->expectsOutput('Translation file created successfully at ' . config('lang-helper.lang-folder', 'lang') . '/fr/users.php')
            ->assertExitCode(0);

        $this->assertTrue(File::exists($filePath));

        File::delete($filePath);
    }

    #[Test]
    public function it_does_not_overwrite_existing_file_without_option(): void
    {
        $filePath = base_path(config('lang-helper.lang-folder', 'lang') . '/fr/users.php');
        if (!File::exists(base_path(config('lang-helper.lang-folder', 'lang') . '/fr'))){
            File::makeDirectory(base_path(config('lang-helper.lang-folder', 'lang') . '/fr',0755,true));
        }
        File::put($filePath, "<?php\n\nreturn[\n\t\n];");

        $this->artisan('make:lang', ['name' => 'users', 'lang' => 'fr'])
            ->expectsOutput('The translation file ' . $filePath . ' already exists! If you wish to overwrite it, please use the --overwrite option.')
            ->assertExitCode(1);

        File::delete($filePath);
    }

    #[Test]
    public function it_overwrites_existing_file_with_option(): void
    {
        $filePath = base_path(config('lang-helper.lang-folder', 'lang') . '/fr/users.php');
        if (!File::exists(base_path(config('lang-helper.lang-folder', 'lang') . '/fr'))){
            File::makeDirectory(base_path(config('lang-helper.lang-folder', 'lang') . '/fr',0755,true));
        }
        File::put($filePath, "<?php\n\nreturn[\n\t\n];");

        $this->artisan('make:lang', ['name' => 'users', 'lang' => 'fr', '--overwrite' => true])
            ->expectsOutput('Translation file created successfully at ' . config('lang-helper.lang-folder', 'lang') . '/fr/users.php')
            ->assertExitCode(0);

        File::delete($filePath);
    }

    protected function getPackageProviders($app): array
    {
        return [
            LangHelperServiceProvider::class,
        ];
    }
}