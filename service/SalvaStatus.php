
<?php

session_start();
include_once('../model/Projetos.php');
include_once('../dao/ProjetoDAO.php');
include_once('../dao/StatusDAO.php');
include_once('../dao/JustificativaStatusDAO.php');

if(isset($_POST)){
	$userId  = null;
	if (isset($_COOKIE['userId'])) {
		$userId = $_COOKIE['userId'];
	} else {
		$userId = $_SESSION['usuarioLogado'];
	}
	
    $idP = $_POST['idProjeto'];
	
	$projeto = new Projetos();
	$projeto->setProjeto_Id(htmlspecialchars($_POST['idProjeto']));
	$projeto->setProjeto_Status(htmlspecialchars($_POST['selectStatus']));
	$justificativa = htmlspecialchars($_POST['textoJustificativa']);
	
	$daoStatus = new StatusDAO();
	$nomeStatus = $daoStatus -> getStatusPorId($_POST['selectStatus']);
	
	if(($nomeStatus -> getStatus_Nome() == 'Análise aprovada' || $nomeStatus -> getStatus_Nome() == 'Cancelado') && empty(trim($justificativa))){
			unset($_POST);
			$_SESSION['salvaStatusProjeto'] = 3;
			header('Location: ../view/StatusProjeto.php');
			return 3;
	}
	
	$action = new ProjetoDAO();
	$verify = $action->updateStatusProjeto($projeto);

    $actionJST = new JustificativaStatusDAO();
    $verifyJST = $actionJST->insertJustificativa($idP,$justificativa);
	
	$daoStatus -> salvarAlteracaoStatus($_POST['selectStatus'], $userId);
	
	
	if($verify && $verifyJST){
		unset($_POST);
		$_SESSION['salvaStatusProjeto'] = 1;
		header('Location: ../view/StatusProjeto.php');
		return 1;
	}else{
		unset($_POST);
		$_SESSION['salvaStatusProjeto'] = 2;
		header('Location: ../view/StatusProjeto.php');
		return 2;
	}
}
?>