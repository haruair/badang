<?php
namespace Haruair\Badang;


class Context implements ContextInterface {
  public $body;
  public $headers;

  public function setStatusCode($code) {
    http_response_code($code);
  }
}
