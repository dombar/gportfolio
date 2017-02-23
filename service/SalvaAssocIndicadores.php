<?php
session_start();
include_once('../dao/IndicadoresDAO.php');

if(isset($_POST)){
	
	$dao = new IndicadoresDAO();
	$verify = $dao-> inserirIndicadoresAoProjeto($_POST['indicadoresSelect'], $_POST['idProjeto'], $_POST['valorMaximo'], $_POST['valorMinimo']);
	return $verify;
}
?>