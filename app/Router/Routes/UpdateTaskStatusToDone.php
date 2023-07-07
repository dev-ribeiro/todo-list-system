<?php

namespace App\Router\Routes;

class UpdateTaskStatusToDone
{
  private \PDO $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function done(int $id)
  {
    try {
      $sql = "UPDATE tasks SET status=:status,updated_at=:updated_at WHERE id=:id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([
        'id' => $id,
        'status' => 'finished',
        'updated_at' => gmdate('d/m/Y', time())
      ]);
      http_response_code(202);
      echo "Updated!";
    } catch (\PDOException $error) {
      http_response_code(400);
      echo $error->getMessage();
    }
  }
}
