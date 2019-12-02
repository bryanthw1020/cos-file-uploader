# cos-file-uploader
Laravel file upload using Tencent COS service integration

## Installation
To  install, run `composer require bryanthw1020/cos-file-uploader`.

After installation, run `php artisan vendor:publish` to publish the configuration file.

After publishing configuration please make sure to add this two variable into your `env` file
```
TC_COS_SECRET_ID=
TC_COS_SECRET_KEY=
```

## Usage
Below are the available method to use.

```php
# To Upload Object
CosFileUploader::uploadObject(string $bucket, string $key, string $fileName, string $base64EncodedFile, string$region = 'ap-singapore', string $schema = 'http');
## Example
CosFileUploader::uploadObject('example-bucket-123456', 'example/file/path', 'example.jpg', $base64EncodedFile);

# To Delete Single Object
CosFileUploader::deleteObject(string $bucket, string $key, string $region = 'ap-singapore', string $schema = 'http');
## Example
CosFileUploader::deleteObject('example-bucket-123456', 'example/file/path/example.jpg');

# To Delete Multiple Object
CosFileUploader::deleteObjects(string $bucket, array $keys, string $region = 'ap-singapore', string $schema = 'http');
## Example
CosFileUploader::deleteObjects('example-bucket-123456', ['example/file/path/example1.jpg', 'example/file/path/example2.jpg']);

# To Get Object URL
CosFileUploader::getObjectUrl(string $bucket, string $key, int $duration = 10, string $region = 'ap-singapore', string $schema = 'http');
## Example
CosFileUploader::getObjectUrl('example-bucket-123456', 'example/file/path/example.jpg');
```
