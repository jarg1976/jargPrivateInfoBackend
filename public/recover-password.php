<?php
require_once("../backend/connection.php");

$requestType = $_SERVER["REQUEST_METHOD"];

if ($requestType == "GET" || isset($_SESSION['user']) || !isset($_POST['email'])) {
  die('Access Denied.');
}

$email = trim($_POST['email']);


// Declaração preparada
$sql = "SELECT id, email FROM users WHERE email = ?";


$stmt = $connection->prepare($sql);
// Verifica se a preparação da declaração foi bem-sucedida
if ($stmt === false) {
  die("Erro na preparação da declaração: " . $connection->error);
}


$stmt->bind_param("s", $email);

$stmt->execute();

// Obter o resultado como um array associativo
$resultado = $stmt->get_result()->fetch_assoc();

$id_usuario = $resultado['id']; // Substitua 123 pelo ID real do usuário

// Data e hora atual
$data_hora_atual = new DateTime();
$data_hora_formatada = $data_hora_atual->format('Y-m-d H:i:s');

// Número aleatório
$numero_aleatorio = mt_rand();

// Concatenar os elementos para formar o token
$token_data = $id_usuario . $data_hora_formatada . $numero_aleatorio;

// Hash dos dados do token
$token = hash('sha256', $token_data);

// Exibir o token gerado (apenas para fins de demonstração)
echo "Token: " . $token;

$sql = "INSERT INTO passwords_tokens (user_id, token) VALUES (?, ?)";
$stmt = $connection->prepare($sql);

// Verificar se a preparação da declaração foi bem-sucedida
if ($stmt === false) {
  die("Erro na preparação da declaração: " . $connection->error);
}

// Vincular parâmetros
$stmt->bind_param("is", $id_usuario, $token);

// Executar a instrução preparada
if ($stmt->execute() === true) {
  echo "Token inserido com sucesso na tabela password_tokens.";
} else {
  echo "Erro ao inserir o token: " . $stmt->error;
}

// Fechar a instrução preparada e a conexão
$stmt->close();
$conn->close();
?>