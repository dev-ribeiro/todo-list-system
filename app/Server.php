<?php

namespace App;

use App\Connections\MySQLConnection;
use App\Connections\SQLiteConnection;

class Server
{
  public function start()
  {
    $method = $_SERVER['REQUEST_METHOD'];

    $path = $_SERVER['PATH_INFO'] ?? '/';

    $env = $_ENV['PHP_ENV'] === 'production' ? 'production' : 'development';

    $conn = $_ENV['PHP_ENV'] === 'production' ? new MySQLConnection() : new SQLiteConnection();

    $pdo = $conn->connect();

    $router = new Router($pdo);

    $router->handler($method, $path);
  }
}
