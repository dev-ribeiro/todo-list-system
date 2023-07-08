<?php

namespace App;

use App\Controllers\ApiController;
use App\Controllers\ViewController;

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
    } elseif ($method === 'GET' || $path === '/') {
      $view = new ViewController();
      $view->index();
    } else {
      http_response_code(403);
      echo "Not Allowed";
    }
  }
}
