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
			$assunto	       = 'Recuperaчуo de senha.';
			$mensagem	       = 'Sua senha щ: '.$results->getUsuario_Senha();
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

?>