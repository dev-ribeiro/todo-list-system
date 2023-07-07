<?php

namespace App\Router\Routes;

class UpdateTaskStatusToUndone
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function undone(int $id)
  {
    try {
      $sql = "UPDATE tasks SET status=:status,updated_at=:updated_at WHERE id=:id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([
        'id' => $id,
        'status' => 'pending',
        'updated_at' => gmdate('d/m/Y', time())
      ]);

      http_response_code(204);

      echo json_encode("Updated!");
    } catch (\PDOException $error) {

      http_response_code(400);

      echo json_encode($error->getMessage());
    }
  }
}
