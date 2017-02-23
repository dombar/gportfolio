<?php
session_start();
include('../dao/IndicadoresDAO.php');
if(isset($_POST)){
	$dao = new IndicadoresDAO();
	$resultado = $dao -> pesquisaIndicadores(null, $_POST['id']);
	$_SESSION['indicadorEditar'] = $resultado[0] -> getIndicadores_Nome();
}

?>