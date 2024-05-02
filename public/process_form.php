<?php

require_once("../backend/connection.php");
require_once("../backend/models/User.php");

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {



  // Obtém os dados do formulário
  $name = $_POST["name"];
  $photo = $_FILES["photo"];
  
  // Verifica se a foto foi enviada com sucesso
  if ($photo["error"] == UPLOAD_ERR_OK) {
   
    // Redimensiona a foto para 500x500
    $targetDir = "assets/images/users/";
    $targetFile = $targetDir . basename($photo["name"]);

    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    $targetFileResized = $targetDir . uniqid() . "." . $imageFileType; // Novo nome de arquivo único
    $maxWidth = 500;
    $maxHeight = 500;
    
    list($width, $height) = getimagesize($photo["tmp_name"]);
    $ratio = min($maxWidth / $width, $maxHeight / $height);
    $newWidth = $width * $ratio;
    $newHeight = $height * $ratio;

    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    
    $source = imagecreatefromjpeg($photo["tmp_name"]); // Supondo que a imagem seja JPEG
    imagecopyresized($newImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    imagejpeg($newImage, $targetFileResized); // Salva a imagem redimensionada
    imagedestroy($newImage);
    imagedestroy($source);

    // Insere os dados no banco de dados
    $sql = "INSERT INTO users (name, photo) VALUES ('$name', '$targetFileResized')";
    if ($connection->query($sql) === TRUE) {
      echo "Dados inseridos com sucesso!";
    } else {
      echo "Erro ao inserir os dados: " . $connection->error;
    }
  } else {
    echo "Erro no envio da foto: " . $photo["error"];
  }

  // Fecha a conexão com o banco de dados
  $connection->close();
}
