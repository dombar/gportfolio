<?php
session_start();
include_once('../dao/UsuarioDAO.php');
if(isset($_POST)){
	$action = new UsuarioDAO();
	$action -> inserirModulosUsuario($_POST['codigo'], $_POST['nome']);
}
?>