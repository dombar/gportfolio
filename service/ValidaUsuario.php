<?php
session_start();
include_once('../dao/UsuarioDAO.php');
$_SESSION['cod'] = 0;

if (isset($_POST)) {
    if (isset($_POST['inputPassword'])) {
        $controle = true;
        $email    = htmlspecialchars($_POST['inputEmail']);
        $senha    = htmlspecialchars($_POST['inputPassword']);
        $validate = new UsuarioDAO();
        $results  = $validate->validaUsuario($email, $senha);
        if (isset($results)) {
            foreach ($results as $cliente) {
                if (isset($_POST['checkLembrar'])) {
                    setcookie('userId', $cliente->getUsuario_Id(), (time() + (8 * 3600)),'/');
                    header('Location: ../view/ListaIndex.php');
                } else {
					$_SESSION['usuarioLogado'] = $cliente->getUsuario_Id();
                    setcookie('userId', $cliente->getUsuario_Id(), (time() - 3600), '/');
                    header('Location: ../view/ListaIndex.php');
                }
            }
        }

        if(empty($results)){
            $_SESSION['cod'] = 1;
            header('Location: ../index.php');
        }
    }
}
?>