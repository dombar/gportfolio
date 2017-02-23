<?php
include('../dao/IndicadoresDAO.php');
if(isset($_POST)){
    $dao = new IndicadoresDAO();
    $verify = $dao -> deletarIndicadorProjeto($_POST['idIndicador'], $_POST['idProjeto']);
}

?>