<?php
   session_start();
   $logado;
   $verificaEmail;
   if(isset($_SESSION['cod'])){
   		$logado = $_SESSION['cod'];
   }
   if(isset($_SESSION['codEmail'])){
     $verificaEmail = $_SESSION['codEmail'];
   }
   
   ?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <title>LOGIN</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
      <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
            <!-- Fav and touch icons -->
      <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
      <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
	  
      <script src="js/jquery-3.1.0.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/index.css" type="text/css">
   </head>
   <body>
      <div class="container">
         <section id="login">
            <div class="row">
               <div class="col-xs-12 col-md-4 col-lg-4 col-sm-4 col-md-offset-4 col-lg-offset-4 col-sm-offset-4">
                  <div class="form-wrap">
                     <h1>Gerenciador de Portfólios</h1>
                     <form role="form" method="post" id="login-form" action="service/ValidaUsuario.php" autocomplete="off">
                        <?php
                           if(isset($verificaEmail)){
								if($verificaEmail == 1){
									echo '<div class="alert alert-danger" role="alert"><strong>Erro!</strong> E-mail não existe na base.</div>';
								}else if($verificaEmail == 2){
									echo '<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Senha enviada para o e-mail informado</div>';
								}
								unset($_SESSION['codEmail']);
                           }
                           
                                                if(isset($logado)){
                                                		if($logado == 1){
                                                			echo '<div class="alert alert-danger" role="alert"><strong>Erro!</strong> Usuário e senha inválidos.</div>';
                                                }
                                                	unset($_SESSION['cod']);
                                                }
                                             ?>
                        <div class="form-group">
                           <label for="email" class="sr-only">Email</label>
                           <input type="email" name="inputEmail" id="email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="form-group">
                           <label for="key" class="sr-only">Password</label>
                           <input type="password" name="inputPassword" id="key" class="form-control" placeholder="Senha" required>
                        </div>
                        <div class="form-check">
                           <label class="form-check-label">
                           <input class="form-check-input" type="checkbox" value="" name="checkLembrar">
                           Manter-se conectado
                           </label>
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Entrar">
                     </form>
                     <a href="view/ModalEsqueciSenha.php" class="forget" data-toggle="modal" data-target="#modal_senha">Esqueci minha senha.</a>
                     <hr>
                  </div>
               </div>
            </div>
      </div>
      </div>
      </section>
      <div class="modal fade" id="modal_senha">
         <div class="modal-dialog" role="document" >
            <div class="modal-content modal-sm">
               <?php
                  include_once('view/EsqueciSenha.php');
                  ?>
            </div>
         </div>
      </div>
      </div>
   </body>
</html>
