<?php
session_start();
include('../dao/ProjetoDAO.php');
if(isset($_POST)){
	$dao = new ProjetoDAO();
	$verify = $dao -> deletaProjeto($_POST['codigo']);
	if($verify){
		unset($_SESSION['projetos']);
		echo '<script src="../js/pesquisa-projeto.js"></script>';
		echo '<script type="text/javascript">pesquisaProjeto(null,null);</script>';
	}
}
?>