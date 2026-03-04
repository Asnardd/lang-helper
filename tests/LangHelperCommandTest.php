<?php

use Illuminate\Support\Facades\File;

beforeEach(function () {
    $langFolder = config('lang-helper.lang-folder', 'lang');

    if (! File::exists(base_path($langFolder))) {
        File::makeDirectory(base_path($langFolder), 0755, true);
    }
});

it('displays help for make:lang', function () {
    $this->artisan('help make:lang')
        ->assertSuccessful();
});

it('creates a new translation file and its directory', function () {
    $langFolder = config('lang-helper.lang-folder', 'lang');
    $filePath = base_path("$langFolder/fr/users.php");

    $this->artisan('make:lang', ['name' => 'users', 'lang' => 'fr'])
        ->expectsOutput("Translation file created successfully at $langFolder/fr/users.php")
        ->assertExitCode(0);

    expect(File::exists($filePath))->toBeTrue();

    File::deleteDirectory(base_path("$langFolder/fr"));
});

it('refuses to overwrite an existing file without --overwrite', function () {
    $langFolder = config('lang-helper.lang-folder', 'lang');
    $filePath = base_path("$langFolder/fr/users.php");

    File::ensureDirectoryExists(base_path("$langFolder/fr"));
    File::put($filePath, "<?php\n\nreturn[\n\t\n];");

    $this->artisan('make:lang', ['name' => 'users', 'lang' => 'fr'])
        ->expectsOutput("The translation file $filePath already exists! If you wish to overwrite it, please use the --overwrite option.")
        ->assertExitCode(1);

    File::deleteDirectory(base_path("$langFolder/fr"));
});

it('overwrites an existing file when --overwrite is passed', function () {
    $langFolder = config('lang-helper.lang-folder', 'lang');
    $filePath = base_path("$langFolder/fr/users.php");

    File::ensureDirectoryExists(base_path("$langFolder/fr"));
    File::put($filePath, "<?php\n\nreturn[\n\t\n];");

    $this->artisan('make:lang', ['name' => 'users', 'lang' => 'fr', '--overwrite' => true])
        ->expectsOutput("Translation file created successfully at $langFolder/fr/users.php")
        ->assertExitCode(0);

    File::deleteDirectory(base_path("$langFolder/fr"));
});
