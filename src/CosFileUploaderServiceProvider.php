<?php

namespace bryanthw1020\CosFileUploader;

use Illuminate\Support\ServiceProvider;

class CosFileUploaderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'cos_file_uploader_lang');
        $this->publishes([
            __DIR__ . '/../config/cosfileuploader.php' => config_path('cosfileuploader.php'),
        ]);
        $this->publishes([
            __DIR__ . '/../resources/lang/en/errors.php' => resource_path('resources/lang/en/errors.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cosfileuploader.php', 'cosfileuploader');
    }
}
