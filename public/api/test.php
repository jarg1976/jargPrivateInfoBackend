<?php

require_once("../../backend/connection.php");
require_once("../../backend/models/User.php");
require '../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
// Chave secreta para verificar o token JWT
$secret_key = "mydev";

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

    $sql = "SELECT * FROM users";

    $stmt = $connection->prepare($sql);
    // Verifica se a preparação da declaração foi bem-sucedida
    if ($stmt === false) {
      die("Erro na preparação da declaração: " . $connection->error);
    }

    $stmt->execute();

    // Obter o resultado como um array associativo
    $resultado = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    // Retorna os dados do usuário (neste caso, apenas o nome de usuário)
    echo json_encode(array("user" => $decoded, "users" => $resultado));
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
