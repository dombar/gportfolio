<?php
   include('../dao/UsuarioDAO.php');
   include('../view/principal.php');
    $statusUsuario = null;
   if(isset($_SESSION['usuarioPost'])){
	   $statusUsuario = $_SESSION['usuarioPost'];
   }
   
   $usEditar = null;
   if(isset($_SESSION['usuarioEditar'])){
	      $listResult = $_SESSION['usuarioEditar'];
	    foreach ($listResult as $key=> $value){
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
   </head>
   <body>
      <div class="container">
         <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
		  <div class="page-header">
            <h3>Cadastro de Usuário</h3>
		 </div>
            <br>
								 										<ol class="breadcrumb">
  <li><a href="../view/ListaIndex.php">Início</a></li>
  <li><a href="../view/PesquisaUsuario.php">Pesquisa de Usuário</a></li>
  <li class="active">Cadastro de Usuário</li>
</ol>
<br>
            <form class="form-horizontal" action="../service/SalvarUsuario.php" method="post" name="formSalvarUsuario">
			<?php
                           if(isset($statusUsuario)){
								if($statusUsuario == 2){
									echo '<div class="row">';
									echo '<div class="col-md-10">';
									echo '<div class="alert alert-danger" role="alert"><strong>Erro!</strong> Erro ao salvar usuário.</div>';
									echo '</div>';
									echo '</div>';
								}else if($statusUsuario == 1){
									echo '<div class="row">';
									echo '<div class="col-md-10">';
									echo '<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Usuário salvo com sucesso</div>';
									echo '</div>';
									echo '</div>';
								}else if($statusUsuario == 3){
									echo '<div class="row">';
									echo '<div class="col-md-10">';
									echo '<div class="alert alert-danger" role="alert"><strong>Erro!</strong> E-mail já cadastrado na base.</div>';
									echo '</div>';
									echo '</div>';
								}
                           }
						   unset($_SESSION['usuarioPost']);
						   $statusUsuario = null;
                     ?>
               <div class="form-group">
			   <?php
			   if(isset($codigo)){
							echo '<input type="text" name="inputIdUsuario" value="'.$codigo.'" hidden>';
			   }
			   ?>
                  <label class="col-md-1 control-label">Nome: </label>
                  <div class="col-md-6">
				  <?php
				  if(isset($nome)){
					  echo '<input type="text" id="inputNomeUsuario" name="inputNomeUsuario" value="'.$nome.'" class="form-control" size="60" required>';
				  }else{
					  echo '<input type="text" id="inputNomeUsuario" name="inputNomeUsuario" value="" class="form-control" size="60" required>';
				  }
					  ?>
                     
                  </div>
                  <label class="col-md-1 control-label">Perfil: </label>
                  <div class="col-md-2">
				  <select class="form-control" name="selectPerfil" required>
				    <?php
                        if (isset($perfil)) {
								echo '<option value="'.$perfil.'">'.$perfil.'</option>';
						}
                         ?>
						<option value="Administrador">Administrador</option>
                        <option value="Analista">Analista</option>
                        <option value="Gerente">Gerente</option>
                        <option value="Líder">Líder</option>
						<option value="Operador">Operador</option>
						<option value="Técnico">Técnico</option>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-1 control-label">Email: </label>
                  <div class="col-md-6">
				  	   <?php
				if(isset($email)){
					echo '<input type="text" id="inputEmailUsuario" name="inputEmailUsuario" value="'.$email.'" class="form-control" size="60" required>'; 
				}else{
					echo '<input type="text" id="inputEmailUsuario" name="inputEmailUsuario" value="" class="form-control" size="60" required>';
				}
			   ?>
                    
                  </div>
               </div>
			   <div class="form-group">
                  <label class="col-md-1 control-label">Senha: </label>
                  <div class="col-md-3">
                     <input type="password" id="inputSenhaUsuario" name="inputSenhaUsuario" value="" class="form-control" size="20" required>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-1 control-label">Cargo: </label>
                  <div class="col-md-6">
				  <?php
					if(isset($cargo)){
						echo '<input type="text" id="inputCargoUsuario" name="inputCargoUsuario" value="'.$cargo.'" class="form-control" size="60" required>';
					}else{
						echo '<input type="text" id="inputCargoUsuario" name="inputCargoUsuario" value="" class="form-control" size="60" required>';
					}
				  ?>
                     
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-1 control-label">Telefone: </label>
                  <div class="col-md-3">
				  <?php
					if(isset($telefone)){
						echo '<input type="text" id="inputTelefoneUsuario" name="inputTelefoneUsuario" value="'.$telefone.'" class="form-control" size="20">';
					}else{
						echo '<input type="text" id="inputTelefoneUsuario" name="inputTelefoneUsuario" value="" class="form-control" size="20">';
					}
				  ?>
                     
                  </div>
               </div>
         </div>
		 <div class="row">
		    <div class="col-md-2 col-md-offset-8">
				<button id="btCancelarUsuario" class="btn btn-danger" onClick="document.location.href='../view/PesquisaUsuario.php'">Cancelar</button>
				<button id="btSalvarUsuario" class="btn btn-success" type="submit"> Salvar </button>
			</div>
		 </div>
         </form>
      </div>
      </div>
   </body>
</html>