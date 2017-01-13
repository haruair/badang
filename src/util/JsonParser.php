<?php
namespace Haruair\Badang\Util;

use Haruair\Badang\MiddlewareInterface;
use Haruair\Badang\ContextInterface;


class JsonParser implements MiddlewareInterface {
  public function next(ContextInterface $ctx) {
    $ctx->headers[] = 'Content-Type: application/json';
    $body = $ctx->body;
    $json = json_encode($body);
    if (json_last_error() !== JSON_ERROR_NONE) {
      $ctx->setStatusCode(500);
      $ctx->body = null;
    }
    else {
      $ctx->setStatusCode(200);
      $ctx->body = $json;
    }
  }
}
