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
            $senhaEnvio = geraSenha(8);
            $nomeDestinatario  = $results->getUsuario_Nome();
			$destinatario 	   = $results->getUsuario_Email();
			$assunto	       = 'Recupera��o de senha.';
            $mensagem	       = 'Sua senha �: '. $senhaEnvio;
			$redirectPage      = '../index.php';
			$enviaEmail        = new EmailService();
			$enviaEmail        -> mail($destinatario, $assunto, $mensagem, $redirectPage, $nomeDestinatario);
            $validate -> updateSenhaUsuario($results->getUsuario_Id(), $senhaEnvio);
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

function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true)
{
    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $retorno = '';
    $caracteres = '';
    $caracteres .= $lmin;
    if ($maiusculas) $caracteres .= $lmai;
    if ($numeros) $caracteres .= $num;
    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
        $rand = mt_rand(1, $len);
        $retorno .= $caracteres[$rand-1];
    }
    return $retorno;
}

?>