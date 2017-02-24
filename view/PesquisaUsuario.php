<?php
include('../dao/UsuarioDAO.php');
include('../view/principal.php');
$acesso = new AcessoUsuario();
$verifica = $acesso -> acessoUsuario();
?>

<html lang="pt-br">
   <head>
      <meta charset="UTF-8">
   </head>
   <body>
      <div class="container">
         <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
		  <div class="page-header">
            <h3>Pesquisa de Usuário</h3>
		</div>
            <br>
										 										<ol class="breadcrumb">
  <li><a href="../view/ListaIndex.php">Início</a></li>
  <li class="active">Pesquisa Usuário</li>
</ol>
<br>
            <form class="form-inline">
               <div class="row">
                  <div class="col-md-2">
                     <label>Código: </label>
                     <div class="form-group">
                        <input type="text" id="inputCodigoUsuario" value="" class="form-control" size="6">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label>Nome: </label>
                     <div class="form-group">
                        <input type="text" id="inputNomeUsuario" value="" class="form-control" size="60">
                     </div>
                  </div>
                  <div class="col-md-1">
                     <div class="form-group">
                        <button id="btPesquisaUsuario" class="form-control" onclick="pesquisaUsuario(null,null)" autofocus>Buscar</button>
                     </div>
                  </div>
                  <div class="col-md-1">
                     <div class="form-group">
					 <?php
						if($verifica -> getCadastrar_usuario()){
							echo '<button id="btCadastrarUsuario" class="form-control" formaction="../view/CadastroUsuario.php">Cadastrar</button>';
						}else{
							echo '<button id="btCadastrarUsuario" class="form-control" formaction="../view/CadastroUsuario.php" disabled>Cadastrar</button>';
						}
					 ?>
                        
                     </div>
                  </div>
               </div>
               <br>
				<?php
				    include('../service/ListaUsuario.php');
				?>
            </form>
         </div>
      </div>
   </body>
</html>