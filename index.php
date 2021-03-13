<?php
//Importando classes PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 
//Diferença do Include e do Require - Caso haja algum erro, o include gera um erro, mas permite a continuação do script. Já o require retorna um erro fatal e termina o script.

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Para não aparecer nenhuma mensagem de erro
    $mail->isSMTP();                           //Configura o mail pra usar o protocolo SMTP
    $mail->Host = 'vps.siteexemplo.com';          //Aqui deve ser utilizado o seu host
    $mail->SMTPAuth   = true;                  //Permite a autenticação SMTP
    $mail->Username = 'usuario@exemplo.com';      //SMTP username
    $mail->Password = 'senha';                //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  //Habilita o protocolo de segurança TLS; porém ssl tbm é aceito.
    $mail->Port = 587;                         //Determina qual porta TCP será usada para conexão

    //Recipients
    $mail->setFrom('usuario@exemplo.com', 'email_enviado');       //Envia o email
    $mail->addAddress('usuario2@examplo.net', 'email_recebido');  //Recebe o email
    $mail->addReplyTo('info@example.com', 'Information');         //Após receber o email, pode-se definir um email de resposta

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; //Caso não haja suporte ao email HTML, aparece essa mensagem

    $mail->send(); //envia
    echo 'Message has been sent'; //Se deu tudo certo, aparece isso
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; //Se houve algum erro, aparece isso
}