<?php
include('../view/principal.php');
$acesso = new AcessoUsuario();
$verifica = $acesso -> acessoUsuario();
?>

<html lang="pt-br">
   <head>
      <meta charset="UTF-8">
      <script src="../js/pesquisa-indicadores.js"></script>
   </head>
   <body>
      <div class="container">
         <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
            <div class="page-header">
               <h3>Relatório de Indicadores</h3>
            </div>
            <br>
            <ol class="breadcrumb">
               <li><a href="../view/ListaIndex.php">Início</a></li>
               <li class="active">Relatório de Indicadores</li>
            </ol>
            <br>
            <form class="form-inline">
               <div class="row">
                  <div class="col-md-2">
                     <label>Código: </label>
                     <div class="form-group">
                        <input type="text" id="inputCodigoIndicador" value="" class="form-control" size="6">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label>Nome: </label>
                     <div class="form-group">
                        <input type="text" id="inputNomeIndicador" value="" class="form-control" size="60">
                     </div>
                  </div>
                  <div class="col-md-1">
                     <div class="form-group">
                        <button id="btPesquisaProjeto" class="form-control" type="button" onclick="pesquisaIndicadoresRelatorioTela()" autofocus>Buscar</button>
                     </div>
                  </div>
               </div>
               <br>
               <?php
                  include('../service/ListaIndicadoresRelatorio.php');
                  ?>
            </form>
         </div>
      </div>
   </body>
</html>