<?php

namespace App;

use App\Router\RouteHandler;

class Server
{
  public function start()
  {
    header("Content-Type: application/json");

    $method = $_SERVER['REQUEST_METHOD'];

    $path = $_SERVER['PATH_INFO'] ?? '/';

    $router = new RouteHandler();

    $router -> handler($method, $path);
  }
}
