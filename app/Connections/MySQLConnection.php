<?php

namespace App\Connections;

use \PDO;
use \PDOException;

class MySQLConnection
{
  private PDO $pdo;

  public function __construct()
  {
    $host = 'localhost';
    $dbname = 'todo_list_app';
    $user = 'root';
    $password = 'root';

    try {
      $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

      $this->pdo = new PDO($dsn, $user, $password);

      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Falha na conexão: " . $e->getMessage();
    }
  }

  public function connect()
  {
    return $this->pdo;
  }
}
