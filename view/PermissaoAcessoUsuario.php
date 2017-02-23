<?php
   include('../view/principal.php');
   include('../dao/UsuarioDAO.php');
   
  $usEditar = null;
   if(isset($_SESSION['usuarioEditar'])){
	      $usEditar = $_SESSION['usuarioEditar'];
	    foreach ($usEditar as $key=> $value){
			$nome = $value['nome'];
			$email = $value['email'];
			$cargo = $value['cargo'];
			$telefone = $value['telefone'];
			$codigo = $value['codigo'];
			$perfil = $value['perfil'];
			break;
		}
   }

   ?>
<html lang="pt-br">
   <head>
      <meta charset="UTF-8">
	  <link rel="stylesheet" href="../css/bootstrap-select.min.css" type="text/css">
	  <script src="../js/bootstrap-select.js"></script>
	  <script src="../js/salva-permissao.js"></script>
   </head>
   <body>
      <div class="container">
         <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
		  <div class="page-header">
            <h3>Permissão de acesso usuário.</h3>
			</div>
            <br>
										 										<ol class="breadcrumb">
  <li><a href="../view/ListaIndex.php">Início</a></li>
  <li><a href="../view/PesquisaUsuario.php">Pesquisa de Usuário</a></li>
  <li class="active">Permissão de acesso usuário</li>
</ol>
<br>
            <form class="form-inline" name="formAssociacaoIndicadores">
               <div class="row">
                 <div class="col-md-2">
					<label class="control-label">Código: </label>
					<div class="form-group">
                     <?php
                        echo '<input name="idProjeto" id="idProjeto" value="'.$codigo.'" type="hidden">';
                        echo '<h4>'.$codigo.'</h4>';
                        ?>
						</div>
                  </div>
				   <div class="col-md-4">
				  <label class="control-label">Nome: </label>
                  <div class="form-group">
                     <?php
                        echo '<h4>'.$nome.'</h4>';
                        ?>
                  </div>
               </div>
			      <div class="col-md-4">
				  <label class="control-label">Cargo: </label>
                  <div class="form-group">
                     <?php
                        echo '<h4>'.$cargo.'</h4>';
                        ?>
                  </div>
               </div>
			  </div>
			<br>			   
			 <div class="row">  
			  <div class="col-md-6">
				  <label class="control-label">Módulos: </label>
                  <div class="form-group">
				    <?php
                        $ind = new UsuarioDAO();
                        $resultsStF  = $ind->verificaModulosUsuario($codigo);							
                        echo '<select id="nomesSelecaoPermissao" name="permissaoSelect" class="selectpicker" multiple>';
                        if (isset($resultsStF)) {
                        	foreach ($resultsStF as $st) {
                        		echo '<option>'.$st -> getPermissao_Nome().'</option>';
                        	}
                        }
                        echo '</select>';
                    ?>
					<?php
					echo '<button id="btVincularUsuario" onclick="salvaPermissaoUsuario('.$codigo.')" class="btn btn-success btn-responsive">Vincular</button>';
					?>
                  </div>
				  </div>
			 <div class="col-md-4">
			 <label class="control-label">Permissões: </label>
               <div class="form-group">
                     <?php
                        $ind= new UsuarioDAO();
                        $resultsSt  = $ind->consultaModulosUsuario($codigo);						
                        echo '<ul>';
                        if (isset($resultsSt)) {
                        	foreach ($resultsSt as $st) {
                        		echo '<li value="'.$st->getPermissao_Id().'">'.$st->getPermissao_Nome().'</li>';
                        	}
                        }
                        echo '</ul>';
                        ?>
				  </div>
				 </div>
				
               </div>
			   <br>
            </form>
         </div>
      </div>
      </div>
   </body>
</html>