<?php
include('../view/principal.php');
?>

<html lang="pt-br">
   <head>
      <meta charset="UTF-8">
	  <script src="../js/pesquisa-indicadores.js"></script>
	  <script src="../js/editar-indicadores.js"></script>
   </head>
   <body>
      <div class="container">
         <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
		  <div class="page-header">
            <h3>Pesquisa Indicadores</h3>
			</div>
            <br>
					<ol class="breadcrumb">
  <li><a href="../view/ListaIndex.php">Início</a></li>
  <li><a href="../view/PesquisaProjeto.php">Pesquisa de Projeto</a></li>
  <li class="active">Pesquisa Indicadores</li>
</ol>
<br>
            <form class="form-inline">
               <div class="row">
                  <div class="col-md-6">
                     <label>Nome: </label>
                     <div class="form-group">
                        <input type="text" id="inputNomeIndicador" value="" name="nomeIndicador" class="form-control" size="62">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <button type="button" class="btn btn-primary pull-right" id="btPesquisaIndicador" class="form-control" onClick="pesquisaIndicadores()" autofocus>Buscar</button>
                     </div>
                     <div class="form-group">
                        <button type="button" class="btn btn-primary pull-right" id="btCadastrarIndicador" class="form-control" onClick="cadastroIndicador()">Cadastrar</button>
                     </div>
                     <div class="form-group">
                        <button type="button" class="btn btn-primary pull-right" id="btAssociarIndicador" class="form-control" onClick="associarIndicadores()">Associar Indicadores</button>
                     </div>
				   </div>
               </div>
               <br>
				<?php
				    include('../service/ListaIndicadores.php');
				?>
            </form>
         </div>
      </div>
   </body>
</html>