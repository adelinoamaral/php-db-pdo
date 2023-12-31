<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

/**
 * Retirado de: https://www.codexworld.com/send-html-email-php-gmail-smtp-phpmailer/
 * Website: https://github.com/PHPMailer/PHPMailer
 * Author: Adelino Amaral
 * Modified: 12-10-2019
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
        $mail->Username   = MAIL_USERNAME;                  // SMTP username
        $mail->Password   = MAIL_PASSWORD;                  // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = MAIL_PORT;                      // TCP port to connect to
        $mail->Encoding = 'base64'; // aceita nomes dos anexos com cedilas e acentos
        $mail->CharSet = 'utf-8';   // aceita no corpo da mensagem caracteres especiais   


        //Recipients
        $mail->setFrom(MAIL_FROM, MAIL_REMETENTE);

        // Add a recipient
        foreach($destinatarios as $destinatario)
        {
            $mail->addAddress($destinatario);   
            //$mail->addReplyTo('info@example.com', 'Information'); // 
        }

        //$mail->addCC('cc@example.com');   // com conhecimento de
        //$mail->addBCC('bcc@example.com'); // com conhecimento de

        // Add attachments
        $mail->addAttachment('files/1.jpg');
        $mail->addAttachment('files/notas.rtf');

        // Este conteúdo normalmente vem de um formulário
        $mail->isHTML(true);    // Set email format to HTML
        $mail->CharSet = "UTF-8";
        $mail->Subject = 'Teste de envio';
        $mail->Body    = 'camarada, amanhã é  <b>reunião</b> de grupo.';
        //$mail->AltBody = 'Este texto é para cliente que não suportam texto com HTML';

        $mail->send();
        //echo 'O email foi enviado';
        return TRUE;
    } catch (Exception $e) {
        //echo "Ocorreu um erro no envio do email: {$mail->ErrorInfo}";
        return FALSE;
    }
}



/**
 * Exemplo de envio de um email
 */
$assunto ="Reunião de alunos";
$mensagem = '<p>Exmo Sr. <b> Fernando Gomes</b>,<br> informo que a sua encomenda chega no dia 22-01-2019.';
$mensagem .= 'Veirique os anexos.';
$destinatarios = [
    "adelino.amaral@gmail.com", 
    "p389@esenviseu.net"
];

// procede ao envio do email
$result = enviar($assunto, $mensagem, $destinatarios);

// verifica o estado do email
if($result)
{
    echo "Email enviado com sucesso";
}
else {
    echo "Email não enviado";
}