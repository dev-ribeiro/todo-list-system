<?php

namespace App\Router;

use App\Router\Routes\CreateTaskRoute;
use App\Router\Routes\GetTaskByIdRoute;
use App\Router\Routes\ListAllTasksRoute;


class RouteHandler
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function handler(string $method, string $path)
  {
    if ($method == 'GET' && $path === '/task') {
      $route = new ListAllTasksRoute($this->pdo);

      $tasks = $route->getAllTasks();

      echo json_encode($tasks);
    } elseif ($method == 'GET' && preg_match('/^\/task\/(\d+)$/', $path, $matches)) {
      $id = $matches[1];

      $route = new GetTaskByIdRoute($this->pdo);

      $route->getTaskById($id);
    } elseif ($method == 'POST' && $path === '/task') {
      $body = json_decode(file_get_contents("php://input"));

      $task = $body->task;

      $route = new CreateTaskRoute($this->pdo);

      $route->create($task);
    } else {
      http_response_code(404);
      echo "Route not found";
    }
  }
}
