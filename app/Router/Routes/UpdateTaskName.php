<?php

namespace App\Router\Routes;

class UpdateTaskName
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function updateTaskName(string $task, int $id)
  {
    try {
      $sql = "UPDATE tasks SET task=:task,updated_at=:updated_at WHERE id=:id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([
        'id' => $id,
        'task' => $task,
        'updated_at' => gmdate('d/m/Y')
      ]);
      http_response_code(202);
      echo "Updated!";
    } catch (\PDOException $error) {
      http_response_code(400);
      echo $error->getMessage();
    }
  }
}
