<?php

require '../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
// Chave secreta para verificar o token JWT
$secret_key = "myprivate";

$headers = getallheaders();
$authorizationHeader = $headers['Authorization'] ?? '';


// Verifica se o token JWT está presente na solicitação
if (isset($authorizationHeader)) {
  // Obtém o token JWT da solicitação
  $auth_header = $authorizationHeader;
  $token = explode(" ", $auth_header)[1];

  try {
    // Decodifica e verifica o token JWT
    $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));

    // Retorna os dados do usuário (neste caso, apenas o nome de usuário)
    echo json_encode(array("username" => $decoded->username));
  } catch (Exception $e) {
    // Se houver erro ao decodificar o token JWT, retorna um erro
    http_response_code(401);
    echo json_encode(array("message" => "Token inválido."));
  }
} else {
  // Se o token JWT não estiver presente na solicitação, retorna um erro
  http_response_code(401);
  echo json_encode(array("message" => "Token não fornecido."));
}
