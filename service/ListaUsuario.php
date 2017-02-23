<?php
echo '<script src="../js/pesquisa-usuario.js"></script>';
$acesso = new AcessoUsuario();
$verifica = $acesso -> acessoUsuario();
if(empty($_SESSION['controlUsuario'])){
	$control = 1;
}else{
	$control = $_SESSION['controlUsuario'];
}

if (!empty($_SESSION['listaUsuarios'])) {
    echo '   <table class="table">';
    echo '      <thead>';
    echo '         <tr>';
    echo '           <th>Código</th>';
    echo '            <th>Nome</th>';
    echo '         </tr>';
    echo '      </thead>';
    foreach ($_SESSION['listaUsuarios'] as $key => $value) {
        echo '      <tbody>';
        echo '        <tr>';
        echo '           <td>' . $value['codigo'] . '</td>';
        echo '           <td>' . $value['nome'] . '</td>';
        echo '            <td class="text-right">';
		if($verifica -> getEditar_usuario()){
			echo ' <button type="button" onClick="pesquisaUsuario('.$value['codigo'].',null)" class="btn btn-success btn-responsive" aria-label="Left Align">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar
				  </button>';
		}else{
			echo ' <button type="button" onClick="pesquisaUsuario('.$value['codigo'].',null)" class="btn btn-success btn-responsive" aria-label="Left Align">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Visualizar
				  </button>';
		}
		
		if($verifica -> getEditar_permissao_usuario()){
			echo ' <button type="button" onClick="direcionamentoPagina('.$value['codigo'].')" class="btn btn-info btn-responsive" aria-label="Left Align">
									<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Permissões Acesso
				  </button>';
		}else{
			echo ' <button type="button" onClick="direcionamentoPagina('.$value['codigo'].')" class="btn btn-info btn-responsive" aria-label="Left Align" disabled>
									<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Permissões Acesso
				  </button>';
		}
		
		if($verifica -> getExcluir_usuario()){
			echo ' <button type="button" class="btn btn-danger btn-responsive" aria-label="Left Align" onClick="deletarUsuario('.$value['codigo'].')">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Excluir
				</button>';
		}else{
			echo ' <button type="button" class="btn btn-danger btn-responsive" aria-label="Left Align" disabled>
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Excluir
				</button>';
		}
								
			
								
		echo '						</td>';
        echo '         </tr>';
        echo '      </tbody>';
    }
    echo '   </table>';
}else{
    if(!empty($value['codigo']) || !empty($value['nome'])){
        echo 'NENHUM USUÁRIO CADASTRADO.';
	    $_SESSION['controlUsuario'] = 2;
    }else{
	    echo '<script type="text/javascript">pesquisaUsuario(null,'.$control.');</script>';
	    if (!empty($_SESSION['listaUsuarios'])) {
        echo '   <table class="table">';
        echo '      <thead>';
        echo '         <tr>';
        echo '           <th>Código</th>';
        echo '            <th>Nome</th>';
        echo '         </tr>';
        echo '      </thead>';
            foreach ($_SESSION['listaUsuarios'] as $key => $value) {
                echo '      <tbody>';
                echo '        <tr>';
                echo '           <td>' . $value['codigo'] . '</td>';
                echo '           <td>' . $value['nome'] . '</td>';
                echo '            <td class="text-right">
								<button type="button" onClick="pesquisaUsuario('.$value['codigo'].')" class="btn btn-success btn-responsive" aria-label="Left Align">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar
								</button>
								<button type="button" class="btn btn-info btn-responsive" aria-label="Left Align">
									<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Permissões Acesso
								</button>
								<button type="button" class="btn btn-danger btn-responsive" aria-label="Left Align">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Excluir
								</button>
								</td>';
                echo '         </tr>';
                echo '      </tbody>';
            }
            echo '   </table>';
        }
    }
}
 
?>