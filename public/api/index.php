<?php

require '../../vendor/autoload.php';

use Firebase\JWT\JWT;

// Chave secreta para assinar o token JWT
$secret_key = "
";

// Verifica se a solicitação é um POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  var_dump($_POST['username']);
  // Verifica se os dados de login foram enviados
  if (isset($_POST['username']) && isset($_POST['password'])) {
      // Simule a autenticação. Aqui você pode fazer a verificação no banco de dados.
      $username = $_POST['username'];
      $password = $_POST['password'];

      // Verifica se o usuário e a senha são válidos (apenas um exemplo)
      if ($username === 'jarg' && $password === '123') {
          // Se forem válidos, gera um token JWT
          $token = array(
            "iss" => "mydev.privateinfo.com",
            "aud" => "mydev.privateinfo.com",
            "iat" => time(),
            "exp" => time() + 3600, // Expira em 1 hora
            "username" => $username
          );

          // Assina o token JWT com a chave secreta
          $jwt = JWT::encode($token, $secret_key, 'HS256');

          // Retorna o token JWT para o cliente
          echo json_encode(array("token" => $jwt));
      } else {
          // Se as credenciais estiverem incorretas, retorna um erro
          http_response_code(401);
          echo json_encode(array("message" => "Credenciais inválidas."));
      }
  } else {
      // Se os dados de login não forem fornecidos, retorna um erro
      http_response_code(400);
      echo json_encode(array("message" => "Dados de login não fornecidos."));
  }
} else {
    // Se a solicitação não for um POST, retorna um erro
    http_response_code(405);
    echo json_encode(array("message" => "Método não permitido."));
}
?>



?>