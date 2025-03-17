<?php
require_once("../backend/connection.php");
require_once("../backend/models/User.php");


$username = 'test';
$email = 'test@gmail.com';
$password = 'test';
$address = 'test';

// Gerar hash da senha
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (email, name, password, photo, address) VALUES ('$email', '$username', '$hashed_password', '$email', '$email')";
mysqli_query($connection, $sql);


// Salvar o usuário e a senha no banco de dados (este é um exemplo simplificado)
// Aqui você deve usar uma conexão com seu banco de dados e uma query SQL
// para inserir os dados na tabela de usuários
// Exemplo:
// $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$hashed_password')";
// mysqli_query($conexao, $sql);
