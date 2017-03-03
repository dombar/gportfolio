<?php
echo '<script src="../js/pesquisa-projeto.js"></script>';
echo '<script src="../js/pesquisa-indicadores.js"></script>';

include('../dao/StatusDAO.php');

$acesso = new AcessoUsuario();
$verifica = $acesso -> acessoUsuario();
$listaProjetos = null;

if(isset($_SESSION['projetos'])){
	$listaProjetos = $_SESSION['projetos'];
}else{
	echo '<script type="text/javascript">pesquisaProjeto(null,null);</script>';
	$listaProjetos = $_SESSION['projetos'];
}

if (!empty($listaProjetos)) {
	echo ' <div class="table-responsive">';
    echo '   <table class="table">';
    echo '      <thead>';
    echo '         <tr>';
    echo '           <th>Código</th>';
    echo '            <th>Nome</th>';
	echo '            <th>Data término real</th>';
	echo '            <th>Status</th>';
    echo '         </tr>';
    echo '      </thead>';
    foreach ($listaProjetos as $key => $value) {
	$daoStatus = new StatusDAO();
	$status = $daoStatus -> getStatusPorId($value['IdST']);
        echo '      <tbody>';
        echo '        <tr>';
        echo '           <td>' . $value['codigo']. '</td>';
        echo '           <td>' . $value['nome']. '</td>';
		 echo '           <td>' . date('d/m/Y', strtotime($value['dataR'])). '</td>';
        echo '           <td>' . $status -> getStatus_Nome() . '</td>';
        echo '            <td class="text-right"> ' ;
		
		if($verifica -> getEditar_projeto() && $status -> getStatus_Nome() != 'Cancelado' && $status -> getStatus_Nome() != 'Encerrado'){
			echo ' <button type="button" onClick="pesquisaProjeto('.$value['codigo'].',null)" class="btn btn-success btn-responsive" aria-label="Left Align">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar
								</button>';
		}else{
			echo ' <button type="button" onClick="pesquisaProjeto('.$value['codigo'].',null)" class="btn btn-success btn-responsive" aria-label="Left Align">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Visualizar
								</button>';
		}
					
	    if($verifica -> getEditar_status_projeto() && $status -> getStatus_Nome() != 'Cancelado' && $status -> getStatus_Nome() != 'Encerrado'){
			echo ' <button type="button" class="btn btn-info btn-responsive" onClick="editarProjetoStatus('.$value['codigo'].')" aria-label="Left Align">
									<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Status
								</button>';
		}else{
			echo ' <button type="button" class="btn btn-info btn-responsive" onClick="editarProjetoStatus('.$value['codigo'].')" aria-label="Left Align" disabled>
									<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Status
								</button>';
		}
		
		if($verifica -> getEditar_membros_projeto() && $status -> getStatus_Nome() != 'Cancelado' && $status -> getStatus_Nome() != 'Encerrado'){
			echo ' <button type="button" class="btn btn-warning btn-responsive" onClick="editarProjetoMembros('.$value['codigo'].')" aria-label="Left Align">
									<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Membros
								</button>';
		}else{
			echo ' <button type="button" class="btn btn-warning btn-responsive" onClick="editarProjetoMembros('.$value['codigo'].')" aria-label="Left Align" disabled>
									<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Membros
								</button>';
		}
		
		if($verifica -> getEditar_indicadores_projeto() && $status -> getStatus_Nome() != 'Cancelado' && $status -> getStatus_Nome() != 'Encerrado'){
			echo ' <button type="button" class="btn btn-primary btn-responsive" onClick="pesquisaIndicadores('.$value['codigo'].')"aria-label="Left Align">
									<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Indicadores
								</button>';
		}else{
			echo ' <button type="button" class="btn btn-primary btn-responsive" onClick="pesquisaIndicadores('.$value['codigo'].')"aria-label="Left Align" disabled>
									<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Indicadores
								</button>';
		}
		
		if($verifica -> getExcluir_projeto() && $status -> getStatus_Nome() != 'Cancelado' && $status -> getStatus_Nome() != 'Encerrado'){
			echo ' <button type="button" class="btn btn-danger btn-responsive" onClick="deletaProjeto('.$value['codigo'].')" aria-label="Left Align">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Excluir
								</button>';
		}else{
			echo ' <button type="button" class="btn btn-danger btn-responsive" onClick="deletaProjeto('.$value['codigo'].')" aria-label="Left Align" disabled>
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Excluir
								</button>';
		}
	
		echo '</td>';	
								
								
							
								
								
        echo '         </tr>';
        echo '      </tbody>';
    }
    echo '   </table>';
	echo '</div>';
}
 
?>