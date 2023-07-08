<?php

namespace App;

use App\Connections\SQLiteConnection;

class Server
{
  public function start()
  {
    $method = $_SERVER['REQUEST_METHOD'];

    $path = $_SERVER['PATH_INFO'] ?? '/';

    $conn = new SQLiteConnection();

    $pdo = $conn -> connect();

    $router = new Router($pdo);

    $router -> handler($method, $path);
  }
}
