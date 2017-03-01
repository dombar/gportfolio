<?php
echo '<script src="../js/pesquisa-projeto.js"></script>';
echo '<script src="../js/pesquisa-indicadores.js"></script>';

include('../dao/ProjetoDAO.php');
include('../dao/IndicadoresDAO.php');

$listaProjetos = null;
$dao = new ProjetoDAO();
if(isset($_SESSION['resultdoIndicadorRelatorio'] )){
    $listaProjetos = $dao -> pesquisaProjetoRelatorioIndicadoresBusca($_SESSION['resultdoIndicadorRelatorio'], null);
}else{
    $listaProjetos = $dao -> pesquisaProjetoRelatorioIndicadoresBusca(null, null);
}
    

if (!empty($listaProjetos)) {
	echo ' <div class="table-responsive">';
    echo '   <table class="table">';
    echo '      <thead>';
    echo '         <tr>';
    echo '           <th>Código</th>';
    echo '            <th>Nome</th>';
	echo '            <th>Indicadores</th>';
    echo '         </tr>';
    echo '      </thead>';
    foreach ($listaProjetos as $m) {
        $daoInd = new IndicadoresDAO();
        $indicadores = $daoInd -> pesquisaIndicadoresVinculados($m -> getProjeto_Id());
        $nomeIndicadores = null;
        echo '      <tbody>';
        echo '        <tr>';
        echo '           <td>' . $m -> getProjeto_Id(). '</td>';
        echo '           <td>' . $m -> getProjeto_Nome() . '</td>';
        foreach($indicadores as $g){
            $nomeIndicadores .=  $g -> getIndicadores_Nome();
            $nomeIndicadores .= ", ";
        }
        if(!empty($nomeIndicadores)){
            echo '           <td>' . rtrim($nomeIndicadores,", "). '</td>';
            echo '            <td class="text-right"> ' ;
             echo ' <button type="button" onClick="pesquisaIndicadoresRelatorio('.$m -> getProjeto_Id().')" class="btn btn-success btn-responsive" aria-label="Left Align">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Visualizar
								</button>';
        }else{
           echo '           <td> Sem indicador </td>'; 
           echo '            <td class="text-right"> ' ;
                echo ' <button type="button" onClick="pesquisaIndicadoresRelatorio('.$m -> getProjeto_Id().')" class="btn btn-success btn-responsive" aria-label="Left Align" disabled>
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Visualizar
								</button>';
        }
	
		echo '</td>';							
        echo '         </tr>';
        echo '      </tbody>';
    }
    echo '   </table>';
	echo '</div>';
}else{
    echo 'NENHUM RESULTADO ENCONTRADO.';
}
 
?>