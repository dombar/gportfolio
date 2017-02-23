<?php
include('../dao/IndicadoresDAO.php');
if(isset($_POST)){
    $dao = new IndicadoresDAO();
    $verify = $dao -> deletarIndicador($_POST['id']);
}

?>