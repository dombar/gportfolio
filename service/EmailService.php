<?php

session_start();

class EmailService
{
    
    public function mail($destinatario, $assunto, $mensagem, $redirectPage, $nomeDestinatario)
    {
        require_once('../vendor/phpmailer/phpmailer/PHPMailerAutoload.php');
        
        $mail = new PHPMailer();
        
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
		$mail->IsHTML(true);
		
        $mail->Charset  = 'utf8_decode';
        $mail->Host     = 'mx1.hostinger.com.br';
        $mail->Port     = '587';
        $mail->Username = 'admin@gportfolio.esy.es';
        $mail->Password = 'spiacI2w';
        $mail->From     = 'admin@gportfolio.esy.es';
        $mail->FromName = 'Gerenciador de Portfolio';
        $mail->Subject  =  $assunto;
        $mail->Body     =  $mensagem;
        
        
        $mail->AddAddress($destinatario, $nomeDestinatario);
        
        if (!$mail->Send()) {
            $_SESSION['codEmail'] = 1;
            header('Location: ' . $redirectPage);
        } else {
            $_SESSION['codEmail'] = 2;
            header('Location: ' . $redirectPage);
        }
    }
}

?>