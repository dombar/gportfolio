<?php

session_start();
include('../dao/IndicadoresDAO.php');

if(isset($_POST)){
	
	$action = new IndicadoresDAO();
	$verify = $action->inserirIndicadores($_POST['nome']);
	if($verify){
		unset($_POST);
		$_SESSION['salvaIndicadoresProjeto'] = 1;
		header('Location: ../view/CadastroIndicadores.php');
		return true;
	}else{
		unset($_POST);
		$_SESSION['salvaIndicadoresProjeto'] = 2;
		header('Location: ../view/CadastroIndicadores.php');
		return false;
	}
	
}
?>