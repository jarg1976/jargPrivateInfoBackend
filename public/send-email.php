<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Configurações de email
$emailRemetente = 'jarg1976@gmail.com';
$senha = '';
$emailDestinatario = 'jarg1976@gmail.com';

// Configurações do servidor SMTP do Microsoft 365
$smtpHost = 'sandbox.smtp.mailtrap.io';
$smtpPort = 2525; // Porta padrão para TLS
$smtpUser = "91669123e08a6d";
$smtpSenha = "644b26c4b21964";
$smtpSecure = 'tls'; // ou 'ssl', dependendo das configurações do seu servidor

// Criar uma nova instância do PHPMailer
$mail = new PHPMailer();

// Configurações do servidor SMTP
$mail->isSMTP();
$mail->Host = $smtpHost;
$mail->Port = $smtpPort;
$mail->SMTPSecure = $smtpSecure;
$mail->SMTPAuth = true;
$mail->Username = $smtpUser;
$mail->Password = $smtpSenha;

// Configurações do email
$mail->setFrom($emailRemetente);
$mail->addAddress($emailDestinatario);

$mail->Subject = 'Bem-vindo!';
$mail->isHTML(true);

// Ler o conteúdo do arquivo HTML
$htmlContent = file_get_contents("./partials/emails/welcome.php");

$mail->Body = $htmlContent;

// Enviar o email
if ($mail->send()) {
  echo 'Email enviado com sucesso!';
} else {
  echo 'Erro ao enviar o email: ' . $mail->ErrorInfo;
}
?>