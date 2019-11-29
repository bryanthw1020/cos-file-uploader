<?php

namespace bryanthw1020\CosFileUploader;

use Qcloud\Cos\Client;
use Qcloud\Cos\Exception\ServiceResponseException;

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

    /**
     * Tencent COS Upload Object
     *
     * @param string $bucket Tencent COS bucket name
     * @param string $key Tencent COS upload path
     * @param string $fileName File name with extension to use when upload to Tencent COS
     * @param string $region Tencent COS region
     * @param string $schema Tencent COS schema. Default to `http`
     *
     * @return array
     */
    public static function uploadObject(string $bucket, string $key, string $fileName, string $base64EncodedFile, string $region = 'ap-singapore', string $schema = 'http')
    {
        try {
            $tencentCos = new self($region, $schema);
            $result = $tencentCos->client->putObject([
                'Bucket' => $bucket,
                'Key' => $key . '/' . $fileName,
                'Body' => base64_decode($base64EncodedFile)
            ]);

            return $result->toArray();
        } catch (ServiceResponseException $ex) {
            throw new \Exception($ex->getMessage());
        } catch (\Exception $ex) {
            throw new \Exception(__('cos_file_uploader_lang::errors.server_error'));
        }
    }

    /**
     * Tencent COS Delete Object
     *
     * @param string $bucket Tencent COS bucket name
     * @param string $key Tencent COS file path
     * @param string $region Tencent COS region
     * @param string $schmea Tencent COS schema. Default to `http`
     *
     * @return array
     */
    public static function deleteObject(string $bucket, string $key, string $region = 'ap-singapore', string $schema = 'http')
    {
        try {
            $tencentCos = new self($region, $schema);
            $result = $tencentCos->client->deleteObject([
                'Bucket' => $bucket,
                'Key' => $key,
            ]);

            return $result->toArray();
        } catch (ServiceResponseException $ex) {
            throw new \Exception($ex->getMessage());
        } catch (\Exception $ex) {
            throw new \Exception(__('cos_file_uploader_lang::errors.server_error'));
        }
    }

    /**
     * Tencent COS Delete Object
     *
     * @param string $bucket Tencent COS bucket name
     * @param array $keys Tencent COS file path
     * @param string $region Tencent COS region
     * @param string $schmea Tencent COS schema. Default to `http`
     *
     * @return array
     */
    public static function deleteObjects(string $bucket, array $keys, string $region = 'ap-singapore', string $schema = 'http')
    {
        try {
            $tencentCos = new self($region, $schema);
            $objects = array_map(function ($key) {
                return ['Key' => $key];
            }, $keys);
            $result = $tencentCos->client->deleteObjects([
                'Bucket' => $bucket,
                'Objects' => $objects,
            ]);

            return $result->toArray();
        } catch (ServiceResponseException $ex) {
            throw new \Exception($ex->getMessage());
        } catch (\Exception $ex) {
            throw $ex;
            throw new \Exception(__('cos_file_uploader_lang::errors.server_error'));
        }
    }

    /**
     * Tencent COS Get Object Temporary Url
     *
     * @param string $bucket Tencent COS bucket name
     * @param string $key Tencent COS file path
     * @param int $duration Tencent COS url validity period in minute(s)
     * @param string $region Tencent COS region
     * @param string $schmea Tencent COS schema. Default to `http`
     *
     * @return array
     */
    public static function getObjectUrl(string $bucket, string $key, int $duration = 10, string $region = 'ap-singapore', string $schema = 'http')
    {
        try {
            $tencentCos = new self($region, $schema);

            return (string) $tencentCos->client->getObjectUrl($bucket, $key, "+ $duration minutes");
        } catch (ServiceResponseException $ex) {
            throw new \Exception($ex->getMessage());
        } catch (\Exception $ex) {
            throw new \Exception(__('cos_file_uploader_lang::errors.server_error'));
        }
    }
}
