<?php

require 'vendor/autoload.php';

use App\Server;

$server = new Server();

$server -> start();

// header("Content-Type: application/json");

// $method = $_SERVER['REQUEST_METHOD'];

// $path = $_SERVER['PATH_INFO'] ?? '/';

// $database_file = "./db/app.sqlite";

// $response = array();

// if ($method === 'GET' && $path === '/task') {
//   try {
//     $pdo = new PDO("sqlite:" . $databaseFile);

//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     $stmt = $pdo->query("SELECT * FROM nome_da_tabela");

//     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     $response['tasks'] = json_encode($results);
//   } catch (PDOException $error) {
//     echo "Erro de conexão com o banco de dados: " . $error->getMessage();
//   }
// } elseif ($method === 'GET' && preg_match('/^\/task\/([^\/]+)$/', $path, $matches)) {
//   $id = $matches[1];

//   $response['message'] = "Endpoint GET /task/$id";
// } elseif ($method === 'POST' && $path === '/task') {
//   $body = file_get_contents("php://input");

//   $data = json_decode($body, true);

//   if ($data === null) {
//     http_response_code(400);
//     $response['error'] = 'Erro ao decodificar o JSON do corpo da requisição';
//     exit;
//   }

//   try {
//     $task = $data['task'];
//     $created_at = gmdate("d/m/Y");
//     $updated_at = gmdate("d/m/Y");

//     $pdo = (new SQLiteConnection())->connect();

//     if ($pdo == null) {
//       echo 'Whoops, could not connect to the SQLite database!';
//       exit;
//     }

//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     $query = "INSERT INTO tasks (task, created_at, updated_at) VALUES (:task, :created_at, :updated_at)";
//     $stmt = $pdo->prepare($query);
//     $stmt->bindParam(':task', $task);
//     $stmt->bindParam(':created_at', $created_at);
//     $stmt->bindParam(':updated_at', $updated_at);
//     $stmt->execute();

//     http_response_code(200);
//     $response['message'] = "Tarefa cadastrada com sucesso";
//   } catch (PDOException $error) {
//     $response['error'] = 'Erro no banco de dados: ' . $error->getMessage();
//   }
// } elseif ($method === 'PUT' && preg_match('/^\/task\/([^\/]+)$/', $path, $matches)) {
//   $id = $matches[1];

//   $response['message'] = "Endpoint PUT /task/$id";
// } elseif ($method === 'PATCH' && preg_match('/^\/task\/([^\/]+)$/', $path, $matches)) {
//   $id = $matches[1];

//   $response['message'] = "Endpoint PATCH /task/$id";
// } elseif ($method === 'DELETE' && preg_match('/^\/task\/([^\/]+)$/', $path, $matches)) {
//   $id = $matches[1];

//   $response['message'] = "Endpoint DELETE /task/$id";
// } else {
//   http_response_code(404);
//   $response['error'] = 'Endpoint não encontrado';
// }

// echo json_encode($response);
