<?php
include('../dao/UsuarioDAO.php');
if(isset($_POST)){
    $dao = new UsuarioDAO();
    $verify = $dao -> removeUsuario($_POST['codigo']);
}
?>