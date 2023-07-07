<?php

namespace App\Controllers;

use App\Models\Task;
use \PDO;
use \PDOException;

class ApiController
{
  private Task $taskModel;

  public function __construct(PDO $pdo)
  {
    $this->taskModel = new Task($pdo);
  }

  public function index(string $method, string $path)
  {
    switch ($path) {
      case ($method === 'GET' && $path === '/api/task'): {
          $tasks = $this->taskModel->getAllTasks();

          echo json_encode($tasks);

          break;
        }
      case ($method === 'GET' && preg_match('/^\/api\/task\/(\d+)$/', $path, $matches)): {
          $id = $matches[1];

          try {
            $task = $this->taskModel->getTaskById($id);

            http_response_code(200);

            echo json_encode($task);
          } catch (PDOException $error) {
            http_response_code(404);

            echo json_encode($error->getMessage());
          }

          break;
        }
      case ($method === 'POST' && $path === '/api/task'): {
          $body = json_decode(file_get_contents("php://input"));

          $task = $body->task;

          if ($task === null) {

            http_response_code(400);
            echo "Informe um nome de task válida";
          }

          try {

            http_response_code(201);
            $this->taskModel->createTask($task);
            echo json_encode("Created task!");
          } catch (PDOException $error) {

            http_response_code(400);
            echo "Error " . $error->getMessage();
          }

          break;
        }
      case ($method === 'PUT' && preg_match('/^\/api\/task\/(\d+)$/', $path, $matches)): {
          $id = $matches[1];

          $body = json_decode(file_get_contents("php://input"));

          $task = $body->task;

          try {
            $this->taskModel->updateTaskName($id, $task);
            http_response_code(204);
          } catch (PDOException $error) {
            echo json_encode("Error " . $error->getMessage());
            http_response_code(400);
          }

          break;
        }
      case ($method === 'PATCH' && preg_match('/^\/api\/task\/done\/(\d+)$/', $path, $matches)): {
          $id = $matches[1];

          $body = json_decode(file_get_contents("php://input"));

          $status = 'finished';

          try {
            $this->taskModel->updateTaskStatus($id, $status);
            http_response_code(204);
          } catch (PDOException $error) {
            echo json_encode("Error " . $error->getMessage());
            http_response_code(400);
          }

          break;
        }
      case ($method === 'PATCH' && preg_match('/^\/api\/task\/undone\/(\d+)$/', $path, $matches)): {
          $id = $matches[1];

          $body = json_decode(file_get_contents("php://input"));

          $status = 'pending';

          try {
            $this->taskModel->updateTaskStatus($id, $status);
            http_response_code(204);
          } catch (PDOException $error) {
            echo json_encode("Error " . $error->getMessage());
            http_response_code(400);
          }

          break;
        }
      case ($method === 'DELETE' && preg_match('/^\/api\/task\/(\d+)$/', $path, $matches)): {
          $id = $matches[1];

          try {
            $this->taskModel->deleteTaskById($id);
            http_response_code(204);
            echo json_encode("Deleted!");
          } catch (PDOException $error) {
            http_response_code(400);
            echo json_encode("Error " . $error->getMessage());
          }

          break;
        }
      default:
        http_response_code(404);
        echo json_encode("Not found");
    }
  }
}
