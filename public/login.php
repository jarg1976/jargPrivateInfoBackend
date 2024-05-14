<?php
require_once("../backend/connection.php");
require_once("../backend/models/User.php");


$username = 'test';
$email = 'test@gmail.com';
$password = 'test';
$address = 'test';

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $connection->query($sql);
$userRow = $result->fetch_assoc();
var_dump($userRow);
$stored_password_hash = $userRow["password"];

if (password_verify($password, $stored_password_hash)) {
  echo "Login bem sucedido!";
} else {
  echo "Nome do utilizador o senha incorretos!";
}


?>
