
<?php

session_start();
include_once('../model/Projetos.php');
include_once('../dao/ProjetoDAO.php');
include_once('../service/FormataDataMysql.php');

if(isset($_POST)){
	
	$dataMysql = new FormatDataMysql();
	
	$projeto = new Projetos();
	$projeto->setProjeto_Id(htmlspecialchars($_POST['inputIdProjeto']));
	$projeto->setProjeto_Nome(htmlspecialchars($_POST['inputNomeProjetoCadastro']));
	$valor = str_replace(",","",$_POST['inputOrcamentoTotalCadastro']);
	$valor1 = str_replace(".","",$valor);
	$projeto->setProjeto_Orcamento_total(htmlspecialchars($valor1/100));
	$projeto->setProjeto_Descricao(htmlspecialchars($_POST['textoDescricao']));
	$projeto->setProjeto_Data_termino($dataMysql -> formataData(htmlspecialchars($_POST['datePickerFim'])));
	$projeto->setProjeto_Data_inicio($dataMysql -> formataData(htmlspecialchars($_POST['datePickerInicial'])));
	$projeto->setProjeto_Data_termino_real($dataMysql -> formataData(htmlspecialchars($_POST['datePickerFimT'])));
	$projeto->setProjeto_Classificacao(htmlspecialchars($_POST['selectClassificacao']));
	$projeto->setProjeto_Gerente_responsavel(htmlspecialchars($_POST['selectGerente']));
	$projeto->setProjeto_Status(htmlspecialchars($_POST['selectStatus']));
	
	$action = new ProjetoDAO();
	if(empty($_POST['inputIdProjeto'])){
		$verify = $action->insertProjeto($projeto);
	}else{
		$verify = $action->updateProjeto($projeto);
	}
	
	if($verify){
	unset($_POST);
	$_SESSION['salvaProjeto'] = 1;
	header('Location: ../view/CadastroProjeto.php');
	return true;
}else{
	$_SESSION['salvaProjeto'] = 2;
	header('Location: ../view/CadastroProjeto.php');
	return false;
}
}
?>