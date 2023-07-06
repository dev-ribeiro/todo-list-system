<?php

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

$path = $_SERVER['PATH_INFO'] ?? '/';

$response = array();

if ($method === 'GET' && $path === '/task') {

  $response['message'] = 'Endpoint GET /task';
} elseif ($method === 'GET' && preg_match('/^\/task\/([^\/]+)$/', $path, $matches)) {
  $id = $matches[1];

  $response['message'] = "Endpoint GET /task/$id";
} elseif ($method === 'POST' && $path === '/task') {

  $response['message'] = 'Endpoint POST /task';
} elseif ($method === 'PUT' && preg_match('/^\/task\/([^\/]+)$/', $path, $matches)) {
  $id = $matches[1];

  $response['message'] = "Endpoint PUT /task/$id";
} elseif ($method === 'PATCH' && preg_match('/^\/task\/([^\/]+)$/', $path, $matches)) {
  $id = $matches[1];

  $response['message'] = "Endpoint PATCH /task/$id";
} elseif ($method === 'DELETE' && preg_match('/^\/task\/([^\/]+)$/', $path, $matches)) {
  $id = $matches[1];

  $response['message'] = "Endpoint DELETE /task/$id";
} else {
  http_response_code(404);
  $response['error'] = 'Endpoint não encontrado';
}

echo json_encode($response);
