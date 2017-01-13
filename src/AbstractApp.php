<?php
namespace Haruair\Badang;


/**
 * Default Base App implementation
 */
abstract class AbstractApp implements AppInterface {
  protected $context = 'Haruair\Badang\Context';
  protected $apps = [];

  /**
   * Bind an app into the array for the processing
   * @param  \Closure|Badang\MiddlewareInterface|\string $app
   */
  public function use($app) {
    $this->apps[] = $app;
  }

  /**
   * Start the app with all processes
   */
  public function start() {
    $ctx = $this->getContext();
    $this->fetch($ctx);
    $this->parseContext($ctx);
  }

  protected function fetch($ctx) {
    foreach($this->apps as $app) {
      if ($app instanceof \Closure) {
        $app($ctx);
      } else if ($app instanceof MiddlewareInterface) {
        $app->next($ctx);
      } else if (function_exists($app)) {
        $app($ctx);
      } else if (class_exists($app)) {
        // @TODO update it with a IoC Container
        $instance = new $app($ctx);
        if ($instance instanceof MiddlewareInterface) {
          $instance->next($ctx);
        }
      } else {
        throw new \ParseError("Parsing '{$app}' failed");
      }
    }
  }

  protected function parseContext($ctx) {
    if(is_array($ctx->headers)) {
      foreach($ctx->headers as $header) {
        header($header);
      }
    } else if (gettype($ctx->headers) == 'string') {
      header($ctx->headers);
    }
    print($ctx->body);
  }

  protected function getContext() {
    return new $this->context();
  }
}
