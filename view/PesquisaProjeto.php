<?php
   include('../dao/ProjetoDAO.php');
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
               <h3>Pesquisa de Projeto</h3>
            </div>
            <br>
            <ol class="breadcrumb">
               <li><a href="../view/ListaIndex.php">Início</a></li>
               <li class="active">Pesquisa de Projeto</li>
            </ol>
            <br>
            <form class="form-inline">
               <div class="row">
                  <div class="col-md-2">
                     <label>Código: </label>
                     <div class="form-group">
                        <input type="text" id="inputCodigoProjeto" value="" class="form-control" size="6">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label>Nome: </label>
                     <div class="form-group">
                        <input type="text" id="inputNomeProjeto" value="" class="form-control" size="60">
                     </div>
                  </div>
                  <div class="col-md-1">
                     <div class="form-group">
                        <button id="btPesquisaProjeto" class="form-control" onclick="pesquisaProjeto()" autofocus>Buscar</button>
                     </div>
                  </div>
                  <div class="col-md-1">
                     <div class="form-group">
                        <?php
                           if($verifica -> getCadastrar_projeto()){
								echo'  <button id="btCadastrarProjeto" class="form-control" formaction="../view/CadastroProjeto.php">Cadastrar</button>';
                           }else{
								echo'  <button id="btCadastrarProjeto" class="form-control" formaction="../view/CadastroProjeto.php" disabled>Cadastrar</button>';
                           }
                           ?>
                     </div>
                  </div>
               </div>
               <br>
               <?php
                  include('../service/ListaProjeto.php');
                  ?>
            </form>
         </div>
      </div>
   </body>
</html>