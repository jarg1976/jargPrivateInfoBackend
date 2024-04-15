<?php

require_once("../backend/connection.php");

$requestType = $_SERVER["REQUEST_METHOD"];

if ($requestType == "POST" || isset($_SESSION['user']) || !isset($_GET['token'])) {
  die('Access Denied.');
}

$token = trim($_GET['token']);

// Declaração preparada
$sql = "SELECT id, created_at FROM passwords_tokens WHERE token = ? AND checked_at IS NULL";


$stmt = $connection->prepare($sql);

if ($stmt === false) {
  die("Erro na preparação da declaração: " . $connection->error);
}

$stmt->bind_param("s", $token);
// Suponha que você tenha a data vinda do banco de dados no formato "YYYY-MM-DD HH:MM:SS"


$stmt->execute();

// Obter o resultado como um array associativo
$resultado = $stmt->get_result()->fetch_assoc();

$data_bd = $resultado['created_at'];



//$data_bd = "2024-04-14 15:30:00";


// Converter a data do banco de dados para um objeto DateTime
$data_bd_obj = DateTime::createFromFormat('Y-m-d H:i:s', $data_bd);

// Obter a data e hora atual
$data_atual = new DateTime();

// Calcular a diferença entre as duas datas
$diferenca = $data_atual->diff($data_bd_obj);

// Verificar se a diferença é menor que 10 minutos
if ($diferenca->i < 10) {
  echo "A diferença é menor que 10 minutos.";
} else {
  echo "A diferença é maior ou igual a 10 minutos.";
}
