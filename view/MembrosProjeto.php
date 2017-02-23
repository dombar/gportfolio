<?php
   include('../dao/UsuarioDAO.php');
   include('../view/principal.php');
   
      if(isset($_SESSION['projetoEditar'])){
    $listResult = $_SESSION['projetoEditar'];
     foreach ($listResult as $key=> $value){
   $codigo = $value['codigo'];
   $nomeProjeto = $value['nome'];
   $desc = $value['desc'];
   $sts = $value['status'];
   $stId = $value['IdST'];
   break;
   }
   }
  
   ?>
<html lang="pt-br">
   <head>
      <meta charset="UTF-8">
	  <link rel="stylesheet" href="../css/bootstrap-select.min.css" type="text/css">
	  <script src="../js/bootstrap-select.js"></script>
	  <script src="../js/salva-membros.js"></script>
   </head>
   <body>
      <div class="container">
         <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
		  <div class="page-header">
            <h3>Membros do Projeto</h3>
		</div>
            <br>
							<ol class="breadcrumb">
  <li><a href="../view/ListaIndex.php">Início</a></li>
  <li><a href="../view/PesquisaProjeto.php">Pesquisa de Projeto</a></li>
  <li class="active">Membros do Projeto</li>
</ol>
<br>
            <form class="form-horizontal" name="formStatus">
			<div class="row">
               <div class="form-group">
                  <label class="col-md-1 control-label">Código: </label>
                  <div class="col-md-1">
                     <?php
                        echo '<input name="idProjeto" value="'.$codigo.'" type="hidden">';
                        echo '<h4>'.$codigo.'</h4>';
                        ?>
                  </div>
				  
				  <label class="col-md-1 control-label">Nome: </label>
                  <div class="col-md-5">
                     <?php
                        echo '<h4>'.$nomeProjeto.'</h4>';
                        ?>
                  </div>
               </div>
			</div>
			<div class="row">
				<div class="form-group">
				  <label class="col-md-1 control-label">Usuários: </label>
                  <div class="col-md-4">
				    <?php
                        $usuario = new UsuarioDAO();
                        $resultsStF  = $usuario->todosMembrosForaDoProjeto($codigo);						
                        echo '<select id="nomesSelecao" class="selectpicker" multiple>';
                        if (isset($resultsStF)) {
                        	foreach ($resultsStF as $st) {
                        		echo '<option>'.$st->getUsuario_Nome().'</option>';
                        	}
                        }
                        echo '</select>';
						echo ' <button id="btVincularUsuario" onClick="salvaMembrosProjeto(null,'.$codigo.')" class="btn btn-success btn-responsive"> Vincular</button>';
                    ?>	
                  </div>
				  
				  <label class="col-md-1 control-label">Vinculados: </label>
                  <div class="col-md-6">
                     <?php
                        $usuario= new UsuarioDAO();
                        $resultsSt  = $usuario->todosMembrosProjeto($codigo);
						if(empty($resultsSt)){
							echo 'Nenhum Usuário Vinculado.';
						}else if (!empty($resultsSt)) {
							echo ' <div class="table-responsive">';
							echo '   <table class="table table-hover table-condensed">';
							echo '      <thead>';
							echo '         <tr>';
							echo '            <th>Nome</th>';
							echo '         </tr>';
							echo '      </thead>';
							foreach ($resultsSt as $st) {
								echo '      <tbody>';
								echo '        <tr>';
								echo '           <td>' . $st->getUsuario_Nome() . '</td>';
								echo '            <td class="text-right">
										<button type="button" class="btn btn-danger" aria-label="Left Align" onClick="deletaUsuarioProjeto('.$codigo.', '.$st->getUsuario_Id().')">
											<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Excluir
										</button>
									</td>';
								echo '         </tr>';
								echo '      </tbody>';
							}
							echo '   </table>';
							echo '   </div>';
                        }
                        ?>
                  </div>
               </div>
			</div>
            </form>
         </div>
		 </div>
   </body>
</html>