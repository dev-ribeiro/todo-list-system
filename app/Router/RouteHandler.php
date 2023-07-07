<?php

namespace App\Router;

use App\Controllers\ApiController;

class RouteHandler
{
  private \PDO $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function handler(string $method, string $path)
  {
    $api = new ApiController($this->pdo);
    $api->index($method, $path);
  }
}
