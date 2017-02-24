<?php
   include('../view/principal.php');
   include('../dao/IndicadoresDAO.php');
   $salvarIndicadores = null;
   if(isset($_SESSION['salvaIndicadoresProjeto'])){
   	   $salvarIndicadores = $_SESSION['salvaIndicadoresProjeto'];
   }
   
   $editarNomeIndicador = null;
   if(isset($_SESSION['indicadorEditar'])){
   	   $editarNomeIndicador = $_SESSION['indicadorEditar'];
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
               <h3>Cadastro Indicadores</h3>
            </div>
            <?php
               if(isset($salvarIndicadores)){
               if($salvarIndicadores == 2){
               echo '<div class="row">';
               echo '<div class="col-md-10">';
               echo '<div class="alert alert-danger" role="alert"><strong>Erro!</strong> Erro ao salvar inddicador.</div>';
               echo '</div>';
               echo '</div>';
               }else if($salvarIndicadores == 1){
               echo '<div class="row">';
               echo '<div class="col-md-10">';
               echo '<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Indicador salvo com sucesso</div>';
               echo '</div>';
               echo '</div>';
               }
               }
               unset($_SESSION['salvaIndicadoresProjeto']);
               $salvarIndicadores = null;
               ?>
            <br>
            <ol class="breadcrumb">
               <li><a href="../view/ListaIndex.php">Início</a></li>
               <li><a href="../view/PesquisaProjeto.php">Pesquisa de Projeto</a></li>
               <li><a href="../view/PesquisaIndicadores.php">Pesquisa Indicadores</a></li>
               <li class="active">Cadastro de Indicadores</li>
            </ol>
            <br>
            <form class="form-inline" action="../service/SalvarIndicador.php" method="post" name="formCadastroIndicadores">
               <div class="row">
               <div class="col-md-7">
                  <label>Nome do Indicador: </label>
                  <div class="form-group">
                     <?php
                        if($editarNomeIndicador != null){
                          $daoInd = new IndicadoresDAO();
                          $result = $daoInd -> pesquisaIndicadores(null, $editarNomeIndicador);
                          $nomeInd = $result[0] -> getIndicadores_Nome();
                          $idInd = $result[0] -> getIndicadores_Id();
                          echo '<input type="hidden" value="'.$idInd.'" name="idIndicador">';
                        	echo '<input type="text" id="inputNomeProjeto" value="'.$nomeInd.'" name="nome" class="form-control" size="60" required>';
                        }else{
                        	echo '<input type="text" id="inputNomeProjeto" value="" name="nome" class="form-control" size="60" required>';
                        }
                        ?>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="form-group">
                     <button id="btSalvarIndicador" class="form-control" autofocus>Salvar</button>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="form-group">
                     <button id="btCancelarIndicador" type="button" class="form-control" onClick="document.location.href='../view/PesquisaIndicadores.php'">Cancelar</button>
                  </div>
               </div>
         </div>
         <br>
         </form>
      </div>
      </div>
   </body>
</html>