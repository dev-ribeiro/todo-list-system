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

    $env = getenv('PHP_ENV');

    $conn = $env === 'dev' ? new SQLiteConnection() : new MySQLConnection();

    $pdo = $conn->connect();

    $router = new Router($pdo);

    $router->handler($method, $path);
  }
}
