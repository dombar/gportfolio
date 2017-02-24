<?php
include('../view/principal.php');
$idP = null;
$noP = null;
      foreach ($_SESSION['relatorioIndicador'] as $key => $value){
                  $idP = $value['idP'];
                  $noP = $value['noP'];
                  break;
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
               <h3>Detalhes indicadores projeto</h3>
            </div>
            <br>
            <ol class="breadcrumb">
               <li><a href="../view/ListaIndex.php">Início</a></li>
               <li><a href="../view/RelatorioIndicadores.php">Relatório de Indicadores</a></li>
               <li class="active">Detalhes indicadores projeto</li>
            </ol>
            <br>
            <div class="row">
                <div class="col-md-2">
                        <?php echo '<h4> Código: '.$idP.' </h4>'; ?>
                </div>
                <div class="col-md-4">
                        <?php echo '<h4> Nome: '.$noP.' </h4>'; ?>
                </div>
           </div>
            <br>
                <?php
                       echo '   <table class="table table-responsive">';
                       echo '      <thead>';
                       echo '         <tr>';
                       echo '           <th>Nome</th>';
                       echo '            <th>Valor Mínimo</th>';
			     echo '            <th>Valor Máximo</th>';
                       echo '         </tr>';
                       echo '      </thead>';
                       foreach ($_SESSION['relatorioIndicador'] as $key => $value) {
                           echo '      <tbody>';
                           echo '        <tr>';
                           echo '           <td>' . $value['nome'] . '</td>';
                           echo '           <td>R$ ' . number_format($value['min'], 2, ',', '.')  . '</td>';
				   echo '           <td>R$ ' . number_format($value['max'], 2, ',', '.')  . '</td>';
                           echo '         </tr>';
                           echo '      </tbody>';
                       }
                       echo '   </table>';
                     ?>
                      
         </div>
      </div>
   </body>
</html>