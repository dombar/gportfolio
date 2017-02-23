<?php
session_start();
include_once('../dao/IndicadoresDAO.php');
include_once('../dao/ProjetoDAO.php');

if(isset($_GET)){
	$res = array();
	$resProject = array();
	$nome = null;
	$idIndicador = null;
	if(!empty($_GET['nome'])){
		$nome = htmlspecialchars($_GET['nome']);
	}
	$dao = new IndicadoresDAO();
	$results = $dao -> pesquisaIndicadores($nome, $idIndicador);
	if(!empty($_GET['idProjeto'])){
		$daoProjeto = new ProjetoDAO();
		$resultsProject = $daoProjeto -> localizarProjetoDetalhado($_GET['idProjeto']);
		if(!empty($resultsProject)){
			$resultP['codigo'] =  $resultsProject -> getProjeto_Id();
			$resultP['nome'] =  $resultsProject-> getProjeto_Nome();
			$resultP['orc_total'] = $resultsProject -> getProjeto_Orcamento_total() * 100;
			$resultP['desc'] = $resultsProject -> getProjeto_Descricao();
			$resultP['dtInicio'] = $resultsProject -> getProjeto_Data_inicio();
			$resultP['dtTermino'] = $resultsProject -> getProjeto_Data_termino();
			$resultP['dtTerminoReal'] = $resultsProject -> getProjeto_data_termino_real();
			$resultP['classificacao'] = $resultsProject -> getProjeto_Classificacao();
			$resultP['gtResponsavel'] = $resultsProject -> getProjeto_Gerente_responsavel();
			$resultP['status'] = $resultsProject -> getProjeto_Status();
			$resultP['IdCL'] = $resultsProject -> getProjeto_IdCL();
			$resultP['IdGP'] = $resultsProject -> getProjeto_IdGP();
			$resultP['IdST'] = $resultsProject -> getProjeto_IdST();
			array_push($resProject, $resultP);
			$_SESSION['projetoEditar'] = $resProject;
		}
	}
	foreach($results as $v) {
		$result['codigo'] =  $v -> getIndicadores_Id();
		$result['nome'] =  $v-> getIndicadores_Nome();
		array_push($res, $result);
	}
	if(!empty($res)){
		$_SESSION['controlIndicadores'] = 2;
		$_SESSION['indicadoresNome'] = $res;
		unset($_GET);
		return true;
	}else{
		$_SESSION['controlIndicadores'] = 1;
		$_SESSION['indicadoresNome'] = $res;
		unset($_GET);
		return false;
	}
}
?>