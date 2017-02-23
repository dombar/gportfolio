<?php
   include('../view/principal.php');
   include('../dao/ProjetoDAO.php');
   ?>
<html lang="pt-br">
   <head>
      <meta charset="UTF-8">
   </head>
   <body> 
 <div class="container">
         <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
		 <div class="col-md-offset-1">
            <div class="row">
               <div class="col-md-5 thumbnail">
                  <h3 class="text-center"><span class="label label-success">Projetos em Andamento</span></h3>
                  <?php
                     $dao = new ProjetoDAO();
                     $projAnmdamento = $dao -> localizarProjetoPorStatus('Em andamento');
                        echo '   <table class="table">';
                       echo '      <thead>';
                       echo '         <tr>';
                       echo '           <th>Código</th>';
                       echo '            <th>Nome</th>';
					   echo '            <th>Data Término Real</th>';
                       echo '         </tr>';
                       echo '      </thead>';
                       foreach ($projAnmdamento as $m) {
                           echo '      <tbody>';
                           echo '        <tr>';
                           echo '           <td>' . $m -> getProjeto_Id() . '</td>';
                           echo '           <td>' . $m -> getProjeto_Nome() . '</td>';
						   echo '           <td>' . date('d/m/Y', strtotime($m -> getProjeto_Data_termino_real())) . '</td>';
                           echo '         </tr>';
                           echo '      </tbody>';
                       }
                       echo '   </table>';
                     ?>
               </div>
			   <div class="col-md-1">
			   </div>
               <div class="col-md-5 thumbnail">
                 <h3 class="text-center"><span class="label label-primary">Projetos Iniciados</span></h3>
                  <?php
                     $dao = new ProjetoDAO();
                     $projCancelado = $dao -> localizarProjetoPorStatus('Iniciado');
                        echo '   <table class="table">';
                       echo '      <thead>';
                       echo '         <tr>';
                       echo '           <th>Código</th>';
                       echo '            <th>Nome</th>';
					   echo '            <th>Data Término Real</th>';
                       echo '         </tr>';
                       echo '      </thead>';
                       foreach ($projCancelado as $m) {
                           echo '      <tbody>';
                           echo '        <tr>';
                           echo '           <td>' . $m -> getProjeto_Id() . '</td>';
                           echo '           <td>' . $m -> getProjeto_Nome()  . '</td>';
						   echo '           <td>' . date('d/m/Y', strtotime($m -> getProjeto_Data_termino_real())) . '</td>';
                           echo '         </tr>';
                           echo '      </tbody>';
                       }
                       echo '   </table>';
                     ?>
               </div>
            </div>
            <div class="row">
               <div class="col-md-5 thumbnail">
                  <h3 class="text-center"><span class="label label-danger">Projetos Cancelados</span></h3>
                  <?php
                     $dao = new ProjetoDAO();
                     $projCancelado = $dao -> localizarProjetoPorStatus('Cancelado');
                        echo '   <table class="table">';
                       echo '      <thead>';
                       echo '         <tr>';
                       echo '           <th>Código</th>';
                       echo '            <th>Nome</th>';
					    echo '            <th>Data Término Real</th>';
                       echo '         </tr>';
                       echo '      </thead>';
                       foreach ($projCancelado as $m) {
                           echo '      <tbody>';
                           echo '        <tr>';
                           echo '           <td>' . $m -> getProjeto_Id() . '</td>';
                           echo '           <td>' . $m -> getProjeto_Nome()  . '</td>';
						   echo '           <td>' . date('d/m/Y', strtotime($m -> getProjeto_Data_termino_real())) . '</td>';
                           echo '         </tr>';
                           echo '      </tbody>';
                       }
                       echo '   </table>';
                     ?>
               </div>
			   <div class="col-md-1">
			   </div>
               <div class="col-md-5 thumbnail">
			   <h3 class="text-center"><span class="label label-warning">Projetos Encerrados</span></h3>
                  <?php
                     $dao = new ProjetoDAO();
                     $projCancelado = $dao -> localizarProjetoPorStatus('Encerrado');
                        echo '   <table class="table">';
                       echo '      <thead>';
                       echo '         <tr>';
                       echo '           <th>Código</th>';
                       echo '            <th>Nome</th>';
					   echo '            <th>Data Término Real</th>';
                       echo '         </tr>';
                       echo '      </thead>';
                       foreach ($projCancelado as $m) {
                           echo '      <tbody>';
                           echo '        <tr>';
                           echo '           <td>' . $m -> getProjeto_Id() . '</td>';
                           echo '           <td>' . $m -> getProjeto_Nome()  . '</td>';
						   echo '           <td>' . date('d/m/Y', strtotime($m -> getProjeto_Data_termino_real())) . '</td>';
                           echo '         </tr>';
                           echo '      </tbody>';
                       }
                       echo '   </table>';
					  
                     ?>
               </div>
            </div>
			</div>
         </div>
      </div>
	  </body>