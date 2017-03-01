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
         $mail->Host     = 'in-v3.mailjet.com';
        $mail->Port     = '587';
        $mail->Username = 'a58e6d3c283c3ee2dff7a1bdb001a58f';
        $mail->Password = '6ff9402337df1ff5fe270a4a6759a6f7';
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