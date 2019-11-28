<?php

namespace bryanthw1020\CosFileUploader\Tests;

use bryanthw1020\CosFileUploader\CosFileUploader;

class FileUploadTest extends TestCase
{
    /** @test */
    public function file_can_be_uploaded_to_tencent_cos()
    {
        $base64EncodedFile = base64_encode(file_get_contents(__DIR__ . '\..\images\sample.jpg'));
        dd(CosFileUploader::upload('test', 'hehehe', $base64EncodedFile));
    }
}
