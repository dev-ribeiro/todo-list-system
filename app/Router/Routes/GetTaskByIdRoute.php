<?php

namespace App\Router\Routes;

class GetTaskByIdRoute
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function getTaskById($id)
  {
    try {
      $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id=:id");
      $stmt->execute(['id' => $id]);
      $task = [];
      while ($row = $stmt->fetch()) {
        $task = [
          'id' => $row['id'],
          'created_at' => $row['created_at'],
          'updated_at' => $row['updated_at'],
          'task' => $row['task'],
          'is_finished' => $row['is_finished']
        ];
      }

      http_response_code(200);
      echo json_encode($task);
    } catch (\PDOException $error) {
      http_response_code(404);
      echo $error->getMessage();
    }
  }
}
