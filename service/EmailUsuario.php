<?php
include('../service/EmailService.php');

Class EmailUsuario{

public function enviaEmailUsuario($usuario){
    try {
            $nomeDestinatario  = $usuario->getUsuario_Nome();
			$destinatario 	   = $usuario->getUsuario_Email();
			$assunto	       = 'Usuário criado.';
            $mensagem	       = 'Login: '. $usuario->getUsuario_Email().' <br> Senha: '. $usuario->getUsuario_Senha();
			$redirectPage      = '../index.php';
			$enviaEmail        = new EmailService();
			$enviaEmail        -> mail($destinatario, $assunto, $mensagem, $redirectPage, $nomeDestinatario);
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}
}

?>