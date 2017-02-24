<?php
session_start();
include_once('../dao/IndicadoresDAO.php');
if(isset($_GET)){
    $resultado = array();
    $dao = new IndicadoresDAO();
    $result = $dao -> detalheIndicadoresRelatorio($_GET['id']);
    foreach($result as $m){
        $r['nome'] = $m -> getIndicadores_Nome();
        $r['max'] = $m -> getindicadores_Valormax();
        $r['min'] = $m -> getIndicadores_Valormin();
        $r['idP'] = $m -> getIndicadores_Idprojeto();
        $r['noP'] = $m -> getIndicadores_Nomeprojeto();
        array_push($resultado, $r); 
    }
    $_SESSION['relatorioIndicador'] = $resultado;
}

?>