<?php

namespace Asnardd\LangHelper\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\text;

class LangHelperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:lang {name?} {lang?} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected string $content = "<?php\n\nreturn[\n\t\n];";

    public function getLangFolderName(): string
    {
        return config('lang-helper.lang-folder','lang');
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $langFolder = $this->getLangFolderName();

        if ($this->argument('name') == null){
            $name = text('What should be the name of the file be ?', required: true, hint: 'users');
        }else{
            $name = $this->argument('name');
        }

        if ($this->argument('lang') == null){
            $lang = text('Which language is the translation for ?', required: true, hint: 'en');
        }else{
            $lang = $this->argument('lang');
        }

        try {
            if (!File::exists("$langFolder/$lang")) {
                File::makeDirectory("lang/$lang");
            }
            File::put("$langFolder/$lang/$name.php",$this->content);
            $this->info("Translation file created successfully at $langFolder/$lang/$name.php}");
            return 1;
        }
        catch(\Exception $e){
            $this->error($e->getMessage());
            $this->fail('Something went wrong...');
        }
    }
}


