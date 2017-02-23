<?php
include_once('../dao/UsuarioDAO.php');
if(isset($_POST)){
	$action = new UsuarioDAO();
	$action -> deletarMembrosDoProjeto($_POST['idProjeto'],$_POST['idUsuario']);
}
?>
