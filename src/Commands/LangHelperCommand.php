<?php

namespace Asnardd\LangHelper\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Throwable;
use function Laravel\Prompts\text;

/**
 *
 */
class LangHelperCommand extends Command
{
    /**
     * @var string The name and signature of the console command.
     */
    protected $signature = 'make:lang 
                                {name? : The name of the new translation file} 
                                {lang? : The name of the language\'s folder} 
                                {--O|overwrite : Whether the file should be overwrite if it already exist} ';

    /**
     * @var string The console command description.
     */
    protected $description = 'This command allow you to create a new translation files.';

    /**
     * Return the lang folder at the root of your project, use by default 'lang' but can be changed in the config.
     * @return string
     */
    protected function getLangFolderName(): string
    {
        return config('lang-helper.lang-folder','lang');
    }

    /**
     * Return the content for the new translation file, can be changed in the config.
     * @return string
     */
    protected function getNewFileContent(): string
    {
        return config('lang-helper.new-file-content',"<?php\n\nreturn[\n\t\n];");
    }

    /**
     * Execute the console command.
     * @return int Return an exit code. (0 for success, 1 for fail)
     */
    public function handle(): int
    {
        $langFolder = $this->getLangFolderName();

        $name = $this->argument('name') ?? text('What should the name of the file be ?', required: true, hint: 'users');
        $lang = $this->argument('lang') ?? text('Which language is the translation for ?', required: true, hint: 'en');

        try {
            $this->createLangDirectory(
                langFolder: $langFolder,
                language: $lang,
            );
            $this->createTranslationFile(
                langFolder: $langFolder,
                language: $lang,
                fileName: $name,
            );
            $this->info("Translation file created successfully at $langFolder/$lang/$name.php");
            return 0;
        }
        catch(\Exception $e){
            $this->error($e->getMessage());
            $this->fail('Something went wrong...');
        }
    }

    /**
     * Create the language directory if it doesn't already exist.
     * @param string $langFolder The lang folder at the root of your project
     * @param string $language The language for which this translation will be, usually in ISO 639-1 format
     * @return void
     */
    protected function createLangDirectory(string $langFolder, string $language): void
    {
        if (!File::exists("$langFolder/$language")) {
            File::makeDirectory("$langFolder/$language");
        }
    }

    /**
     * Create the new translation file if it doesn't already exist or if the overwrite option is true.
     * @param string $langFolder The lang folder at the root of your project
     * @param string $language The language for which this translation will be, usually in ISO 639-1 format
     * @param string $fileName The name of the new translation file
     * @return void
     * @throws Throwable
     */
    protected function createTranslationFile(string $langFolder, string $language, string $fileName): void
    {
        $filePath = "$langFolder/$language/$fileName.php";
        if (File::exists($filePath) && !$this->option('overwrite')) {
            $this->fail("The translation file $filePath already exists! If you wish to overwrite it, please use the --overwrite option.");
        }
        File::put($filePath, $this->getNewFileContent());
    }
}


