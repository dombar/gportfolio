<?php
   include('../view/principal.php');
   include('../dao/IndicadoresDAO.php');
   
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
      <script src="../js/pesquisa-indicadores.js"></script>
      <script src="../js/jquery.mask.js"></script>
   </head>
   <body>
      <script>$(document).ready(function(){
         $('#valorMaximo').mask('000.000,00', {reverse: true});
         $('#valorMinimo').mask('000.000,00', {reverse: true});
         });
      </script>
      <div class="container">
         <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
            <div class="page-header">
               <h3>Associação de Indicadores a projeto.</h3>
            </div>
            <br>
            <ol class="breadcrumb">
               <li><a href="../view/ListaIndex.php">Início</a></li>
               <li><a href="../view/PesquisaProjeto.php">Pesquisa de Projeto</a></li>
               <li><a href="../view/PesquisaIndicadores.php">Pesquisa Indicadores</a></li>
               <li class="active">Associação de Indicadores a projeto</li>
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
                  <div class="col-md-6">
                     <label class="control-label">Nome: </label>
                     <div class="form-group">
                        <?php
                           echo '<h4>'.$nomeProjeto.'</h4>';
                           ?>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-4">
                     <label class="control-label">Valor Máximo:</label>
                     <div class="form-group">
                        <input class="form-control" id="valorMaximo" name="valorMaximo" type="text" required/>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <label class="control-label">Valor Mínimo: </label>
                     <div class="form-group">
                        <input class="form-control" id="valorMinimo" name="valorMinimo" type="text" required/>
                     </div>
                  </div>
               </div>
               <br>			   
               <div class="row">
                  <label class="col-md-1 control-label">Indicador: </label>
                  <div class="col-md-4">
                     <div class="form-group">
                        <?php
                           $ind = new IndicadoresDAO();
                           $resultsStF  = $ind->pesquisaTodosIndicadores($codigo);						
                           echo '<select id="nomesSelecao" name="indicadoresSelect" class="selectpicker" multiple>';
                           if (isset($resultsStF)) {
                           	foreach ($resultsStF as $st) {
                           		echo '<option>'.$st->getIndicadores_Nome().'</option>';
                           	}
                           }
                           echo '</select>';
                           echo '';
                           ?>
                        <button id="btVincularUsuario" onclick="salvarIndicadores()" class="btn btn-success btn-responsive">Vincular</button>
                     </div>
                  </div>
                  <label class="col-md-1 control-label">Vinculados: </label>
                  <div class="col-md-5">
                     <?php
                        $ind= new IndicadoresDAO();
                        $resultsSt  = $ind->pesquisaIndicadoresVinculados($codigo);
                        
                        if(empty($resultsSt)){
                        echo 'Nenhum Indicador Vinculado.';
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
                        echo '           <td>' . $st->getIndicadores_Nome() . '</td>';
                        echo '            <td class="text-right">
                        <button type="button" class="btn btn-danger" aria-label="Left Align" onClick="deletaIndicadorProjeto(' . $st->getIndicadores_Id() . ', '.$codigo.')">
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
            </form>
         </div>
      </div>
   </body>
</html>