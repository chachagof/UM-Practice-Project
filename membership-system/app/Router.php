<?php
class Router
{
  private $routes = [];

  public function addRoute($path, $callback)
  {
    $this->routes[$path] = $callback;
  }

  public function handleRequest($requestUri)
  {
    $path = parse_url($requestUri, PHP_URL_PATH);
    if (array_key_exists($path, $this->routes)) {
      call_user_func($this->routes[$path]);
    } else {
      echo "404 Not Found";
    }
  }
}
