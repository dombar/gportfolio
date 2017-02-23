<?php
   include('../dao/StatusDAO.php');
   include('../view/principal.php');

   $updateStatus = null;
   if(isset($_SESSION['salvaStatusProjeto'])){
	   $updateStatus = $_SESSION['salvaStatusProjeto'];
   }
   
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
   </head>
   <body>
      <div class="container">
         <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
		 <div class="page-header">
            <h3>Alteração status do projeto</h3>
			</div>
            <br>
										 										<ol class="breadcrumb">
  <li><a href="../view/ListaIndex.php">Início</a></li>
  <li><a href="../view/PesquisaProjeto.php">Pesquisa de Projeto</a></li>
  <li class="active">Alterar status do projeto</li>
</ol>
<br>
            <form class="form-horizontal" action="../service/SalvaStatus.php" method="post" name="formStatus">
               <?php
                           if($updateStatus != null){
								if($updateStatus == 2){
									echo '<div class="row">';
									echo '<div class="col-md-10">';
									echo '<div class="alert alert-danger" role="alert"><strong>Erro!</strong> Erro ao salvar status.</div>';
									echo '</div>';
									echo '</div>';
								}else if($updateStatus == 1){
									echo '<div class="row">';
									echo '<div class="col-md-10">';
									echo '<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Status alterado com sucesso</div>';
									echo '</div>';
									echo '</div>';
								}else{
									echo '<div class="row">';
									echo '<div class="col-md-10">';
									echo '<div class="alert alert-danger" role="alert"><strong>Erro!</strong> Para esse status é necessário uma justificativa!</div>';
									echo '</div>';
									echo '</div>';
								}
                           }
						   unset($_SESSION['salvaStatusProjeto']);
						   $updateStatus = null;
                     ?>
               <div class="form-group">
                  <label class="col-md-1 control-label">Código: </label>
                  <div class="col-md-6">
                     <?php
                        echo '<input name="idProjeto" value="'.$codigo.'" type="hidden">';
                        echo '<h4>'.$codigo.'</h4>';
                        ?>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-1 control-label">Nome: </label>
                  <div class="col-md-6">
                     <?php
                        echo '<h4>'.$nomeProjeto.'</h4>';
                        ?>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-1 control-label">Descrição: </label>
                  <div class="col-md-6">
                     <?php
                        echo '<h4>'.$desc.'</h4>';
                        ?>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-1 control-label">Status: </label>
                  <div class="col-md-3">
                     <?php
                        $status= new StatusDAO();
                        $resultsSt  = $status->todosStatus();
                        echo '<select class="form-control" name="selectStatus" required>';
                        if (isset($resultsSt)) {
                        	if(isset($sts)){
                        		echo '<option value="'.$stId.'">'.$sts.'</option>';
                        	}
                        	foreach ($resultsSt as $st) {
                        		if($st->getStatus_Id() != $stId){
                        		echo '<option value="'.$st->getStatus_Id().'">'.$st->getStatus_Nome().'</option>';
                        		}
                        	}
                        }
                        echo '</select>';
                        ?>
                  </div>
               </div>
               <div class="form-group">
                  <label class="col-md-1 control-label">Justificativa: </label>
                  <div class="col-md-6">
                     <?php
                        echo '<textarea class="form-control" name="textoJustificativa" rows="8" cols="124" id="justificativa"></textarea>';
                        ?>
                  </div>
               </div>
			      <div class="row">
               <div class="col-md-1 col-md-offset-5">
                  <div class="form-group">
                     <button id="btCancelarStatus" type="button" class="btn btn-danger btn-responsive pull-right" onClick="document.location.href='../view/PesquisaProjeto.php'">Cancelar</button>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="form-group">
                     <button id="btSalvarStatus" class="btn btn-success btn-responsive pull-right" type="submit" autofocus>Salvar</button>
                  </div>
               </div>
            </div>
            </form>
         
         </div>
      </div>
      </div>
   </body>
</html>