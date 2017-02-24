<?php
session_start();
include('../dao/UsuarioDAO.php');
echo '<script src="../js/pesquisa-usuario.js"></script>';
if(isset($_POST)){
    $dao = new UsuarioDAO();
    $verify = $dao -> removeUsuario($_POST['codigo']);
    unset($_SESSION['listaUsuarios']);
    echo '<script type="text/javascript">pesquisaUsuario(null,null);</script>';
}
?>