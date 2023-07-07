<?php

namespace App\Router\Routes;

class CreateTaskRoute
{
  private $pdo;
  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function create($taskName)
  {
    $createdAt = gmdate('d/m/Y', time());
    $updatedAt = gmdate('d/m/Y', time());

    $sql = 'INSERT INTO tasks(task,created_at,updated_at) '
      . 'VALUES(:task,:start_date,:updated_at)';

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ':task' => $taskName,
      ':start_date' => $createdAt,
      ':updated_at' => $updatedAt
    ]);

    try {
      $this->pdo->lastInsertId();
      http_response_code(201);
      echo "Created task";
    } catch (\PDOException $error) {
      http_response_code(400);
      echo "Error: " . $error->getMessage();
    }
  }
}
