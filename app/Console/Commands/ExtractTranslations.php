<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ExtractTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extract:translations {lang}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extract all translations';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $lang = $this->argument('lang');
        Storage::disk('resources')->put("js/locales/$lang.json", collect(File::allFiles(public_path("/../lang/$lang")))->flatMap(function ($file) use ($lang) {
            return [
                ($translation = $file->getBasename('.php')) => trans(
                    $translation,
                    [
                        'attribute' => '{attribute}',
                        'date' => "{date}",
                        'other' => "{other}",
                        "value" => "{value}",
                        "min" => "{min}",
                        "max" => "{max}",
                        "format" => "{format}",
                        "digits" => "{digits}",
                        "size" => "{size}",
                        "values" => "{values}",
                        "seconds" => "{seconds}",
                        "count" => "{count}",
                        "actionText" => "{actionText}",
                        "vendor" => "{vendor}",
                        "race" => "{race}",
                        "child" => "{child}"
                    ],
                    $lang
                ),
            ];
        })->toJson());
        return Command::SUCCESS;
    }
}