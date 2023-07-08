<?php

namespace App;

use App\Controllers\ApiController;

class Router
{
  private \PDO $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function handler(string $method, string $path)
  {
    if (preg_match('/^\/api/', $path)) {
      $api = new ApiController($this->pdo);
      $api->index($method, $path);
    } else {
      echo json_encode("Common route!");
    }
  }
}
