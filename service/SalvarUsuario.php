<?php
session_start();
include('../model/Usuario.php');
include('../dao/UsuarioDAO.php');
include('../service/EmailUsuario.php');

if(isset($_POST)){
	$usuario = new Usuario();
	$usuario->setUsuario_Nome(htmlspecialchars($_POST['inputNomeUsuario']));
	$usuario->setUsuario_Email(htmlspecialchars($_POST['inputEmailUsuario']));
	if(!empty($_POST['inputIdUsuario'])){
		$usuario->setUsuario_Id($_POST['inputIdUsuario']);
		if(isset($_POST['inputSenhaUsuario'])){
			$usuario->setUsuario_Senha(htmlspecialchars($_POST['inputSenhaUsuario']));
		}
	}else{
		$usuario->setUsuario_Senha(htmlspecialchars($_POST['inputSenhaUsuario']));
	}
	$usuario->setUsuario_Cargo(htmlspecialchars($_POST['inputCargoUsuario']));
	$usuario->setUsuario_Telefone(htmlspecialchars($_POST['inputTelefoneUsuario']));
	$usuario->setUsuario_Perfil(htmlspecialchars($_POST['selectPerfil']));
	
	$dao = new UsuarioDAO();
	$verify = $dao -> inserirUsuario($usuario);

	if(empty($_POST['inputIdUsuario'])){
		$emailUsuario = new EmailUsuario();
		$emailUsuario -> enviaEmailUsuario($usuario);
	}
	
	if($verify && $verify == 1){
		$_SESSION['usuarioPost'] = 1;
		unset($_POST);
		header('Location: ../view/CadastroUsuario.php');
		return true;
	}else if($verify && $verify == 2){
		$_SESSION['usuarioPost'] = 2;
		unset($_POST);
		header('Location: ../view/CadastroUsuario.php');
		return false;
	}else{
		$_SESSION['usuarioPost'] = 3;
		unset($_POST);
		header('Location: ../view/CadastroUsuario.php');
		return false;
	}
}

?>