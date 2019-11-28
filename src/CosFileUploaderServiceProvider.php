<?php

namespace bryanthw1020\CosFileUploader;

use Illuminate\Support\ServiceProvider;

class CosFileUploaderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/cosfileuploader.php' => config_path('cosfileuploader.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cosfileuploader.php', 'cosfileuploader');
    }
}
