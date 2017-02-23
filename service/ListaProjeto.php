<?php
echo '<script src="../js/pesquisa-projeto.js"></script>';
echo '<script src="../js/pesquisa-indicadores.js"></script>';

include('../dao/StatusDAO.php');

$acesso = new AcessoUsuario();
$verifica = $acesso -> acessoUsuario();

$dao = new ProjetoDAO();
$listaProjetos = $dao -> localizarProjeto(null,null);

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
    foreach ($listaProjetos as $m) {
	$daoStatus = new StatusDAO();
	$status = $daoStatus -> getStatusPorId($m -> getProjeto_Status());
        echo '      <tbody>';
        echo '        <tr>';
        echo '           <td>' . $m -> getProjeto_Id(). '</td>';
        echo '           <td>' . $m -> getProjeto_Nome() . '</td>';
		 echo '           <td>' . date('d/m/Y', strtotime($m -> getProjeto_Data_termino_real())). '</td>';
        echo '           <td>' . $status -> getStatus_Nome() . '</td>';
        echo '            <td class="text-right"> ' ;
		
		if($verifica -> getEditar_projeto() && $status -> getStatus_Nome() != 'Cancelado'){
			echo ' <button type="button" onClick="pesquisaProjeto('.$m -> getProjeto_Id().',null)" class="btn btn-success btn-responsive" aria-label="Left Align">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar
								</button>';
		}else{
			echo ' <button type="button" onClick="pesquisaProjeto('.$m -> getProjeto_Id().',null)" class="btn btn-success btn-responsive" aria-label="Left Align">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Visualizar
								</button>';
		}
					
	    if($verifica -> getEditar_status_projeto() && $status -> getStatus_Nome() != 'Cancelado'){
			echo ' <button type="button" class="btn btn-info btn-responsive" onClick="editarProjetoStatus('.$m -> getProjeto_Id().')" aria-label="Left Align">
									<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Status
								</button>';
		}else{
			echo ' <button type="button" class="btn btn-info btn-responsive" onClick="editarProjetoStatus('.$m -> getProjeto_Id().')" aria-label="Left Align" disabled>
									<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Status
								</button>';
		}
		
		if($verifica -> getEditar_membros_projeto() && $status -> getStatus_Nome() != 'Cancelado'){
			echo ' <button type="button" class="btn btn-warning btn-responsive" onClick="editarProjetoMembros('.$m -> getProjeto_Id().')" aria-label="Left Align">
									<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Membros
								</button>';
		}else{
			echo ' <button type="button" class="btn btn-warning btn-responsive" onClick="editarProjetoMembros('.$m -> getProjeto_Id().')" aria-label="Left Align" disabled>
									<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Membros
								</button>';
		}
		
		if($verifica -> getEditar_indicadores_projeto() && $status -> getStatus_Nome() != 'Cancelado'){
			echo ' <button type="button" class="btn btn-primary btn-responsive" onClick="pesquisaIndicadores('.$m -> getProjeto_Id().')"aria-label="Left Align">
									<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Indicadores
								</button>';
		}else{
			echo ' <button type="button" class="btn btn-primary btn-responsive" onClick="pesquisaIndicadores('.$m -> getProjeto_Id().')"aria-label="Left Align" disabled>
									<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Indicadores
								</button>';
		}
		
		if($verifica -> getExcluir_projeto() && $status -> getStatus_Nome() != 'Cancelado'){
			echo ' <button type="button" class="btn btn-danger btn-responsive" onClick="deletaProjeto('.$m -> getProjeto_Id().')" aria-label="Left Align">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Excluir
								</button>';
		}else{
			echo ' <button type="button" class="btn btn-danger btn-responsive" onClick="deletaProjeto('.$m -> getProjeto_Id().')" aria-label="Left Align" disabled>
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