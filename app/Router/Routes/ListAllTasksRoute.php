<?php

namespace App\Router\Routes;

class ListAllTasksRoute
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function getAllTasks()
  {
    $stmt = $this->pdo->query('SELECT * ' . 'FROM tasks');
    $tasks = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tasks[] = [
        'id' => $row['id'],
        'created_at' => $row['created_at'],
        'updated_at' => $row['updated_at'],
        'task' => $row['task'],
        'is_finished' => $row['is_finished']
      ];
    }
    return $tasks;
  }
}
