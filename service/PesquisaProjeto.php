<?php
session_start();
include_once('../dao/ProjetoDAO.php');

if(isset($_GET)){
	$codigo = htmlspecialchars($_GET['codigo']);
	$nome = htmlspecialchars($_GET['nome']);
	$editar = htmlspecialchars($_GET['editar']);
	$dao = new ProjetoDAO();
	$res = array();
	if(empty($editar)){
		$results = $dao -> localizarProjeto($codigo, $nome);
		foreach($results as $v) {
			$result['codigo'] =  $v -> getProjeto_Id();
			$result['nome'] =  $v-> getProjeto_Nome();
			$result['dataR'] =  $v->  getProjeto_data_termino_real();
			$result['IdST'] =  $v->  getProjeto_Status();
			array_push($res, $result);
		}
		if(!empty($res)){
			$_SESSION['control'] = 2;
			$_SESSION['projetos'] = $res;
			unset($_GET);
			return true;
		}
	}else{
		$results = $dao -> localizarProjetoDetalhado($editar);
		if(!empty($results)){
			$result['codigo'] =  $results -> getProjeto_Id();
			$result['nome'] =  $results-> getProjeto_Nome();
			$result['orc_total'] = $results -> getProjeto_Orcamento_total() * 100;
			$result['desc'] = $results -> getProjeto_Descricao();
			$result['dtInicio'] = $results -> getProjeto_Data_inicio();
			$result['dtTermino'] = $results -> getProjeto_Data_termino();
			$result['dtTerminoReal'] = $results -> getProjeto_data_termino_real();
			$result['classificacao'] = $results -> getProjeto_Classificacao();
			$result['gtResponsavel'] = $results -> getProjeto_Gerente_responsavel();
			$result['status'] = $results -> getProjeto_Status();
			$result['IdCL'] = $results -> getProjeto_IdCL();
			$result['IdGP'] = $results -> getProjeto_IdGP();
			$result['IdST'] = $results -> getProjeto_IdST();
			array_push($res, $result);
			$_SESSION['projetoEditar'] = $res;
			unset($_GET);
			return true;
		}
	}
}
?>