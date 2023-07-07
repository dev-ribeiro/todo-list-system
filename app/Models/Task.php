<?php

namespace App\Models;

use \PDO;
use \PDOException;

class Task
{
  private PDO $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function getAllTasks()
  {
    $stmt = $this->pdo->query('SELECT * ' . 'FROM tasks');

    $tasks = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $tasks[] = [
        'id' => $row['id'],
        'created_at' => $row['created_at'],
        'updated_at' => $row['updated_at'],
        'task' => $row['task'],
        'status' => $row['status']
      ];
    }

    return $tasks;
  }

  public function getTaskById(int $id)
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
          'status' => $row['status']
        ];
      }

      return $task;
    } catch (PDOException $error) {
      throw $error;
    }
  }

  public function createTask(string $task)
  {
    $createdAt = gmdate('d/m/Y', time());
    $updatedAt = gmdate('d/m/Y', time());

    $sql = 'INSERT INTO tasks(task,created_at,updated_at) '
      . 'VALUES(:task,:start_date,:updated_at)';

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ':task' => $task,
      ':start_date' => $createdAt,
      ':updated_at' => $updatedAt
    ]);

    try {

      $this->pdo->lastInsertId();
    } catch (PDOException $error) {

      throw $error;
    }
  }

  public function updateTaskName(int $id, string $task)
  {
    try {
      $sql = "UPDATE tasks SET task=:task,updated_at=:updated_at WHERE id=:id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([
        'id' => $id,
        'task' => $task,
        'updated_at' => gmdate('d/m/Y')
      ]);
    } catch (PDOException $error) {
      throw $error;
    }
  }

  public function updateTaskStatus(int $id, string $status)
  {
    try {
      $sql = "UPDATE tasks SET status=:status,updated_at=:updated_at WHERE id=:id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([
        'id' => $id,
        'status' => $status,
        'updated_at' => gmdate('d/m/Y', time())
      ]);

      echo "Updated!";
    } catch (PDOException $error) {
      throw $error;
    }
  }

  public function deleteTaskById(int $id)
  {
    try {
      $sql = "DELETE FROM tasks WHERE id=:id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([
        'id' => $id,
      ]);
    } catch (PDOException $error) {
      throw $error;
    }
  }
}
