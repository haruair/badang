# Badang

Simple web framework for simple things.

## Getting Started

This is not on Packagist yet, update `composer.json` like below:

```json
"repositories": [
    {
        "type":"package",
        "package": {
          "name": "haruair/badang",
          "version":"master",
          "source": {
              "url": "https://github.com/haruair/badang.git",
              "type": "git",
              "reference":"master"
            }
        }
    }
],
"require": {
    "haruair/badang": "master"
}
```

Sample index page.

```php
<?php
require_once('./vendor/autoload.php');

use Haruair\Badang;
$app = new Badang\App();

$app->use(function ($ctx) {
  $ctx->setStatusCode(200);
  $ctx->body = ['hello' => 'world'];
});

$app->use('Haruair\Badang\Util\Response\JsonResponse');

$app->start();
?>
```
