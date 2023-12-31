<?php
/**
 * Este ficheiro irá guardar os dados (registar) do utilizador na tabela users.
 * Envia um email com um link de verificação ao utilizador e guarada na BD.
 * Date: 09/02/2022
 * Author: Adelino Amaral
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader and constants
require 'vendor/autoload.php';
require 'constants.php';

// Instantiation and passing `true` enables exceptions
function load()
{
    $mail = new PHPMailer(true);
    return $mail;
}

/**
 * envia email com assunto, mensagem para 1 ou mais destinatários.
 * $assunto - assunto do email
 * $mensagem - texto da mensagem
 * $destinatarios - array com os vários endereços de email dos destinatário
 */
function enviar($assunto, $mensagem, $destinatarios)
{

    try {
        $mail = load();

        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;              // Enable verbose debug output (https://github.com/PHPMailer/PHPMailer/wiki/SMTP-Debugging)
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();                                    // Send using SMTP
        $mail->Host       = MAIL_HOST;                      // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                           // Enable SMTP authentication
        $mail->Username   = MAIL_USERNAME;                  // SMTP username Gmail
        $mail->Password   = MAIL_PASSWORD;                  // SMTP password Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = MAIL_PORT;                      // TCP port to connect to
        //$mail->SMTPSecure = "ssl";

        //Recipients
        $mail->setFrom(MAIL_FROM, MAIL_REMETENTE);
        //$mail->FromName = 'your_name';

        // Add a recipient
        foreach($destinatarios as $destinatario)
        {
            $mail->addAddress($destinatario);   
            //$mail->addReplyTo('info@example.com', 'Information'); // 
        }

        //$mail->addCC('cc@example.com');   // com conhecimento de
        //$mail->addBCC('bcc@example.com'); // com conhecimento de

        // Add attachments
        // $mail->addAttachment('files/1.jpg');
        // $mail->addAttachment('files/notas.rtf');

        // Este conteúdo normalmente vem de um formulário
        $mail->isHTML(true);    // Set email format to HTML
        $mail->CharSet = "UTF-8";
        $mail->Subject = $assunto;
        $mail->Body    = $mensagem;
        //$mail->AltBody = 'Este texto é para cliente que não suportam texto com HTML';

        $mail->send();
        //echo 'O email foi enviado';
        return TRUE;
    } catch (Exception $e) {
        //echo "Ocorreu um erro no envio do email: {$mail->ErrorInfo}";
        return FALSE;
    }
}

if (isset($_POST['password-reset-token']) && $_POST['email']) {

    include "functions.php";
    // ligação à base de dados
    $conn = pdo_connect_mysql();

    // verifica se o email já se encontra registado na base de dados
    $sql = "SELECT * FROM users WHERE email = :email";
    if($st = $conn->prepare($sql)){
        // ligação dos parâmetros
        $st->bindParam(':email', $parm_email);
        $parm_email = trim($_POST['email']);
        if($st->execute()){
            // senão foi registado então regista e envia um email de verificação
            if($st->rowCount() <= 0){
                // cria um token encriptado
                $token = md5($_POST['email']) . rand(10, 9999);

                // regista a conta do utilizador
                $sql_insert = "INSERT INTO users(username, email, email_verification_link , password) ";
                $sql_insert .= " VALUES(:username, :email, :token, :password)";
                $stm = $conn->prepare($sql_insert);
                $stm->bindValue(':username', $_POST['username']);
                $stm->bindValue(':email', $_POST['email']);
                $stm->bindValue(':token', $token);
                $stm->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT));
                $stm->execute();
                
                // definição do link de verificação que receberá no email
                $link = "<a href='http://localhost/user_registration_email_verification_php/verify-email.php?key=" . $_POST['email'] . "&token=" . $token . "'>Clique e verifique no seu Email</a>";

                $assunto ="Reset à senha";
                $mensagem = $link;
                // Definição dos emails destinatários
                $destinatarios = [
                    "adelino.amaral@gmail.com", 
                    "p389@esenviseu.net"
                ];
                // procede ao envio do email
                $result = enviar($assunto, $mensagem, $destinatarios);
                // verifica o estado do email
                if($result)
                {
                    echo "Confirme o Email enviado na sua caixa de correio";
                }
                else {
                    echo "Problemas com o envio do Email, contacte com o sdministrador.";
                }

            } else {
                echo "O seu email já se encontra registado!";
            }

        }
    }
}
?>