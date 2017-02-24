<?php
session_start();
include('../dao/ProjetoDAO.php');
if(isset($_GET)){
    $dao = new ProjetoDAO();
    $idP = null;
    $noP = null;
    if($_GET['id'] != null){
        $idP = $_GET['id'];
    }
    if($_GET['nome'] != null){
        $noP = $_GET['nome']; 
    }
    $listaProjetos = $dao -> pesquisaProjetoRelatorioIndicadoresBusca($idP, $noP);
    foreach($listaProjetos as $m){
         $_SESSION['resultdoIndicadorRelatorio'] =  $m -> getProjeto_Id();
        return true;
    }
    $_SESSION['resultdoIndicadorRelatorio'] = 1;

}

?>