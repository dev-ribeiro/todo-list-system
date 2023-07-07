<?php

namespace App\Router\Routes;

class DeleteTaskByIdRoute
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function deleteTask($id)
  {
    try {
      $sql = "DELETE FROM tasks WHERE id=:id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([
        'id' => $id,
      ]);

      http_response_code(204);
      echo json_encode("Task deleted successfully");
    } catch (\PDOException $error) {
      echo json_encode($error->getMessage());
    }
  }
}
