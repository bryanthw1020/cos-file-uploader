<?php

namespace bryanthw1020\CosFileUploader\Tests;

use bryanthw1020\CosFileUploader\CosFileUploaderServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            CosFileUploaderServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('cosfileuploader.secret_id', '');
        $app['config']->set('cosfileuploader.secret_key', '');
    }
}
