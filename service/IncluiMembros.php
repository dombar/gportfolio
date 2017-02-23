<?php
include_once('../dao/UsuarioDAO.php');
if(isset($_POST)){
	$action = new UsuarioDAO();
	$action -> vincularMembrosProjeto($_POST['nome'], $_POST['codigo']);
}
?>