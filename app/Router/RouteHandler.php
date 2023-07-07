<?php

namespace App\Router;

class RouteHandler
{
  public function handler(string $method, string $path)
  {
    if ($method === 'GET' && $path === '/') {
      echo "router";
    } else {
      echo "not_found";
    }
  }
}
