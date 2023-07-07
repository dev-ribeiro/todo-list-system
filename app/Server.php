<?php

namespace App;

use App\Router\RouteHandler;
use App\SQLite\SQLiteConnection;

class Server
{
  public function start()
  {
    header("Content-Type: application/json");

    $method = $_SERVER['REQUEST_METHOD'];

    $path = $_SERVER['PATH_INFO'] ?? '/';

    $conn = new SQLiteConnection();

    $pdo = $conn -> connect();

    $router = new RouteHandler($pdo);

    $router -> handler($method, $path);
  }
}
