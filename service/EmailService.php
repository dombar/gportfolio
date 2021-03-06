<?php

class EmailService
{
    
    public function mail($destinatario, $assunto, $mensagem, $redirectPage, $nomeDestinatario)
    {
        require_once('../vendor/phpmailer/phpmailer/PHPMailerAutoload.php');
        
        $mail = new PHPMailer();
        
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
		$mail->IsHTML(true);
		
        $mail->CharSet = 'UTF-8';
         $mail->Host     = '';
        $mail->Port     = '587';
        $mail->Username = '';
        $mail->Password = '';
        $mail->From     = 'baroninet@gmail.com';
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