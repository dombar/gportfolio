<?php
include('../dao/IndicadoresDAO.php');

$resultado = null;
if(!empty($_SESSION['indicadoresNome'])){
    $v = new IndicadoresNome();
    foreach($_SESSION['indicadoresNome'] as $key => $value){
        $v -> setIndicadores_Id($value['codigo']);
        $v -> setIndicadores_Nome($value['nome']);
        $resultado = $v;
        break;
    }
    
}
if(isset($_SESSION['projetoEditar'])){
	$listResult = $_SESSION['projetoEditar'];
		foreach ($listResult as $key=> $value){
			$codigoProjeto = $value['codigo'];
			$dao = new IndicadoresDAO();
			$resultado = $dao -> pesquisaIndicadores(null,null);	
			break;
    }
}

if (!empty($resultado)) {
	echo ' <div class="table-responsive">';
    echo '   <table class="table table-hover table-condensed">';
    echo '      <thead>';
    echo '         <tr>';
    echo '            <th>Nome</th>';
    echo '         </tr>';
    echo '      </thead>';
    foreach ($resultado as $m) {
        echo '      <tbody>';
        echo '        <tr>';
        echo '           <td>' . $m -> getIndicadores_Nome() . '</td>';
        echo '            <td class="text-right">
								<button type="button" class="btn btn-success" aria-label="Left Align" onClick="editarIndicador('.$m -> getIndicadores_Id().');">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar
								</button>
								<button type="button" class="btn btn-danger" aria-label="Left Align" onClick="deletaIndicador('.$m -> getIndicadores_Id().');">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Excluir
								</button>
								</td>';
        echo '         </tr>';
        echo '      </tbody>';
    }
    echo '   </table>';
	echo '   </div';
}else{
	echo 'PROJETO NÃO POSSUÍ INDICADORES CADASTRADOS.';
}
 
?>