<?php

session_start();
$_SESSION['codEmail'] = 0;

include_once('../dao/conexao.php');
include_once('../model/Usuario.php');
include_once('../dao/UsuarioDAO.php');
include('../service/EmailService.php');

if (isset($_POST['inputEmail'])) {
    $email    = htmlspecialchars($_POST['inputEmail']);
    $validate = new UsuarioDAO();
    $results  = $validate->validaUsuarioPorEmail($email);
    try {
        if (isset($results)) {
            $nomeDestinatario  = $results->getUsuario_Nome();
			$destinatario 	   = $results->getUsuario_Email();
			$assunto	       = 'Recupera��o de senha.';
            $mensagem	       = 'Sua senha �: '. md5_decrypt($results->getUsuario_Senha(),$results->getUsuario_Senha());
			$redirectPage      = '../index.php';
			$enviaEmail        = new EmailService();
			$enviaEmail        -> mail($destinatario, $assunto, $mensagem, $redirectPage, $nomeDestinatario);
        }
		
		if (empty($results)) {
			$_SESSION['codEmail'] = 1;
			header('Location: ../index.php');
		}
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}

function md5_decrypt($enc_text, $password, $iv_len = 16)
{
   $enc_text = base64_decode($enc_text);
   $n = strlen($enc_text);
   $i = $iv_len;
   $plain_text = '';
   $iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
   while ($i < $n) {
	   $block = substr($enc_text, $i, 16);
	   $plain_text .= $block ^ pack('H*', md5($iv));
	   $iv = substr($block . $iv, 0, 512) ^ $password;
	   $i += 16;
   }
   return preg_replace('/\\x13\\x00*$/', '', $plain_text);
}

?>