<?php

namespace bryanthw1020\CosFileUploader;

use Qcloud\Cos\Client;

class CosFileUploader
{
    private $client;
    private $secretId;
    private $secretKey;

    public function __construct(string $region, string $schema)
    {
        $this->secretId = config('cosfileuploader.secret_id');
        $this->secretKey = config('cosfileuploader.secret_key');

        if (!$this->client) {
            $this->client = new Client([
                'region' => $region,
                'schema' => $schema,
                'credentials' => [
                    'secretId' => $this->secretId,
                    'secretKey' => $this->secretKey
                ]
            ]);
        }
    }

    public static function upload(string $bucket, string $key, string $base64EncodedFile, string $region = 'ap-singapore', string $schema = 'http')
    {
        $client = new self($region, $schema);
        dd($client->secretId, $client->secretKey);
    }
}
