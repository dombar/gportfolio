<?php
session_start();
if(!isset($_COOKIE['userId'])) {
	if(!isset($_SESSION['usuarioLogado'])){
		header('Location: ../index.php');
	}
}
include('../model/AcessoUsuario.php');

?>

<!DOCTYPE HTML>
<html lang="pt-br">
   <head>
      <title>GERENCIADOR DE PORTFÓLIO</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
      <link rel="stylesheet" href="../css/bootstrap-theme.min.css" type="text/css">
      <link rel="stylesheet" href="../css/principal.css" type="text/css">
      <script src="../js/jquery-3.1.0.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/principal.js"></script>
      <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Fav and touch icons -->
      <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
      <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
   </head>
   <body>
      <nav class="navbar navbar-default bs-docs-nav">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
            </div>
            <a class="navbar-brand" href="#" id="brandPrincipal"><img src="../img/brand.png" width="30" height="40" alt=""></a>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav">
				  <li><a href="../view/ListaIndex.php"><span class="glyphicon glyphicon-home"></span> Início</a></li>
                  <li><a href="../view/PesquisaProjeto.php"><span class="glyphicon glyphicon-paperclip"></span> Projetos</a></li>
                  <li><a href="../view/PesquisaUsuario.php"><span class="glyphicon glyphicon-tower"></span> Cadastro de Usuários</a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
                  <li><a href="../service/Sair.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
               </ul>
            </div>
         </div>
      </nav>
   </body>
</html>