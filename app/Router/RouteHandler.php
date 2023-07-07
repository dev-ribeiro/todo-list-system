<?php

namespace App\Router;

use App\Router\Routes\CreateTaskRoute;
use App\Router\Routes\DeleteTaskByIdRoute;
use App\Router\Routes\GetTaskByIdRoute;
use App\Router\Routes\ListAllTasksRoute;
use App\Router\Routes\UpdateTaskNameRoute;
use App\Router\Routes\UpdateTaskStatusToDoneRoute;
use App\Router\Routes\UpdateTaskStatusToUndoneRoute;

class RouteHandler
{
  private \PDO $pdo;

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
    } elseif ($method == 'PUT' && preg_match('/^\/task\/(\d+)$/', $path, $matches)) {
      $id = $matches[1];

      $body = json_decode(file_get_contents("php://input"));

      $task = $body->task;

      if ($task === null) {
        http_response_code(400);
        echo json_encode("Please pass new task name");
      }

      $route = new UpdateTaskNameRoute($this->pdo);

      $route->updateTaskName($task, $id);
    } elseif ($method == 'PATCH' && preg_match('/^\/task\/done\/(\d+)$/', $path, $matches)) {
      $id = $matches[1];

      $route = new UpdateTaskStatusToDoneRoute($this->pdo);

      $route->done($id);
    } elseif ($method == 'PATCH' && preg_match('/^\/task\/undone\/(\d+)$/', $path, $matches)) {
      $id = $matches[1];

      $route = new UpdateTaskStatusToUndoneRoute($this->pdo);

      $route->undone($id);
    } elseif ($method == 'DELETE' && preg_match('/^\/task\/(\d+)$/', $path, $matches)) {
      $id = $matches[1];

      $body = json_decode(file_get_contents("php://input"));

      $route = new DeleteTaskByIdRoute($this->pdo);

      $route->deleteTask($id);
    } else {
      http_response_code(404);
      echo json_encode("Route not found");
    }
  }
}
