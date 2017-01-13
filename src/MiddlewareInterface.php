<?php
namespace Haruair\Badang;


interface MiddlewareInterface {
  public function next(ContextInterface $ctx);
}
