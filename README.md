# Badang

Simple web framework for simple things.

## Getting Started

```php
<?php
require_once('./vendor/autoload.php');

use Haruair\Badang;
$app = new Badang\App();

$app->bind(function ($ctx) {
  $ctx->setStatusCode(200);
  $ctx->body = ['hello' => 'world'];
});

$app->bind('Haruair\Badang\Util\Response\JsonResponse');

$app->start();
?>
```
