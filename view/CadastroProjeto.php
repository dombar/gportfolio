<?php
include('../dao/ProjetoDAO.php');
include('../view/principal.php');
include('../dao/ClassificacaoDAO.php');
include('../dao/StatusDAO.php');
include('../dao/GerenteResponsavelDAO.php');

$acesso = new AcessoUsuario();
$verifica = $acesso -> acessoUsuario();

if ($verifica -> getEditar_projeto() == null && $verifica -> getCadastrar_projeto() == null) {
?>
<script type="text/javascript">
   $(document).ready(function () {
   $("#readOnlyFields :input").attr("disabled", true); 
   });
</script>
<?php
} else if ($verifica -> getEditar_projeto() == null && isset($_SESSION['projetoEditar'])) {
?>
<script type="text/javascript">
   $(document).ready(function () {
   $("#readOnlyFields :input").attr("disabled", true); 
   });
</script>
<?php
} else if ($verifica -> getCadastrar_projeto() == null && !isset($_SESSION['projetoEditar'])) {
?>
<script type="text/javascript">
   $(document).ready(function () {
   $("#readOnlyFields :input").attr("disabled", true); 
   });
</script>
<?php
}


$updateProjeto = null;
if (isset($_SESSION['salvaProjeto'])) {
    $updateProjeto = $_SESSION['salvaProjeto'];
}

if (isset($_SESSION['projetoEditar'])) {
    $listResult = $_SESSION['projetoEditar'];
    foreach ($listResult as $key => $value) {
        $codigo      = $value['codigo'];
        $nomeProjeto = $value['nome'];
        $orcamento   = $value['orc_total'];
        $desc        = $value['desc'];
        $class       = $value['classificacao'];
        $classId     = $value['IdCL'];
        $gp          = $value['gtResponsavel'];
        $gpId        = $value['IdGP'];
        $sts         = $value['status'];
        $stId        = $value['IdST'];
        $dtInc       = $value['dtInicio'];
        $dtTer       = $value['dtTermino'];
        $dtTerR      = $value['dtTerminoReal'];
        break;
    }
}

?>
<html lang="pt-br">
   <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="../css/daterangepicker.css" type="text/css">
      <link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
      <script src="../js/moment.js"></script>
      <script src="../js/daterangepicker.js"></script>
      <script src="../js/jquery.mask.js"></script>
      <script src="../js/acerta_data.js"></script>
      <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
   </head>
   <body>
      <div class="container" id="readOnlyFields">
         <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
            <div class="page-header">
               <h3>Cadastro de Projeto</h3>
            </div>
            <form class="form-inline" action="../service/SalvaProjeto.php" method="post" name="formProjeto" >
               <br>
               <?php
                  if(isset($updateProjeto)){
                  if($updateProjeto == 2){
                  echo '<div class="row">';
                  ;									echo '<div class="col-md-10">';
                  echo '<div class="alert alert-danger" role="alert"><strong>Erro!</strong> Erro ao salvar projeto.</div>';
                  echo '</div>';
                  echo '</div>';
                  }else if($updateProjeto == 1){
                  echo '<div class="row">';
                  echo '<div class="col-md-10">';
                  echo '<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Projeto salvo com sucesso</div>';
                  echo '</div>';
                  echo '</div>';
                  }
                  }
                  unset($_SESSION['salvaProjeto']);
                  $updateProjeto = null;
                  ?>
               <div class="row">
                  <ol class="breadcrumb">
                     <li><a href="../view/ListaIndex.php">Início</a></li>
                     <li><a href="../view/PesquisaProjeto.php">Pesquisa de Projeto</a></li>
                     <li class="active">Cadastro de Projeto</li>
                  </ol>
               </div>
               <br>
               <div class="col-md-offset-1">
                  <div class="row">
                     <div class="col-md-3">
                        <label class="control-label">Data inicio: </label>
                        <div class="input-group">
                           <input type="text" name="datePickerInicial" id="datePickerInicial" value="" class="form-control" size="6" readonly required/>
                           <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <label class="control-label">Data fim: </label>
                        <div class="input-group">
                           <input type="text" name="datePickerFim"  id="datePickerFim" value="" class="form-control" size="6" readonly required/>
                           <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <label class="control-label">Data real término: </label>
                        <div class="input-group">
                           <input type="text" name="datePickerFimT" id="datePickerFimT" class="form-control"  value="" size="6" readonly required/>
                           <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                        </div>
                     </div>
                  </div>
                  <script type="text/javascript">
                     $(function() {
                         $('input[name="datePickerInicial"]').datepicker({
                             singleDatePicker: true,
                             showDropdowns: true,
                     		locale: {
                                 format: 'DD/MM/YYYY'
                             }
                         }, 
                         function(start, end, label) {
                             var years = moment().diff(start, 'years');
                         });
                     });
                     
                     $(function() {
                         $('input[name="datePickerFim"]').datepicker({
                             singleDatePicker: true,
                             showDropdowns: true,
                     		locale: {
                                 format: 'DD/MM/YYYY'
                             }
                         }, 
                         function(start, end, label) {
                             var years = moment().diff(start, 'years');
                         });
                     });
                     
                     $(function() {
                         $('input[name="datePickerFimT"]').datepicker({
                             singleDatePicker: true,
                             showDropdowns: true,
                     		locale: {
                                 format: 'DD/MM/YYYY'
                             }
                         }, 
                         function(start, end, label) {
                             var years = moment().diff(start, 'years');
                         });
                     });
                     jQuery(function($){
                     $.datepicker.regional['pt-BR'] = {
                     closeText: 'Fechar',
                     prevText: '&#x3c;Anterior',
                     nextText: 'Pr&oacute;ximo&#x3e;',
                     currentText: 'Hoje',
                     monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
                     'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                     monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                     dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
                     dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
                     dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
                     weekHeader: 'Sm',
                     dateFormat: 'dd/mm/yy',
                     firstDay: 0,
                     isRTL: false,
                     showMonthAfterYear: false,
                     yearSuffix: ''};
                     $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
                     });
                  </script>
                  <?php
                     if(isset($dtInc)){
                     	echo '<input type="hidden" id="dtInc" value="'.$dtInc.'"/>
                     	<script type="text/javascript">
                     		acertaData();
                     	</script>';
                     }
                     
                     if(isset($dtTer)){
                     	echo '<input type="hidden" id="dtFim" value="'.$dtTer.'"/>
                     	<script type="text/javascript">
                     		acertaData();
                     	</script>';
                     }
                     
                     if(isset($dtTerR)){
                     	echo '<input type="hidden" id="dtFimT" value="'.$dtTerR.'"/>
                     	<script type="text/javascript">
                     		acertaData();
                     	</script>';
                     }
                     ?>
                  <style>
                     #ui-datepicker-div{
                     display: none;
                     }
                     .ui-datepicker {
                     width: 18em;
                     }
                  </style>
                  <br>
                  <div class="row">
                     <div class="col-md-7">
                        <label>Nome: </label>
                        <div class="form-group">
                           <?php
                              if(isset($nomeProjeto)){
                              	echo '<input type="text" name="inputIdProjeto" value="'.$codigo.'" hidden>';
                              	echo '<input type="text" name="inputNomeProjetoCadastro" value="'.$nomeProjeto.'" class="form-control" size="70" required>';
                              	unset($_SESSION['projetoEditar']);
                              }else{
                              	echo '<input type="text" name="inputNomeProjetoCadastro" id="inputNomeProjetoCadastro" value="" class="form-control" size="70" required>';
                              }
                              ?>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <label>Orçamento total: </label>
                        <div class="form-group">
                           <?php
                              if(isset($orcamento)){
                              	echo '<input type="text" name="inputOrcamentoTotalCadastro" id="inputOrcamentoTotalCadastro" value="'.$orcamento.'" class="form-control" size="10" required>';
                              }else{
                              	echo '<input type="text" name="inputOrcamentoTotalCadastro" id="inputOrcamentoTotalCadastro" value="" class="form-control" size="10" required>';
                              }
                              ?>
                           <script>$(document).ready(function(){
                              $('#inputOrcamentoTotalCadastro').mask('000.000,00', {reverse: true});
                              });
                           </script>
                        </div>
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-md-10">
                        <label>Descrição: </label>
                        <div class="form-group">
                           <?php
                              if(isset($desc)){
                              echo '<textarea class="form-control" name="textoDescricao" rows="8" cols="124" id="comment" required>'.$desc.'</textarea>';
                              }else{
                              echo '<textarea class="form-control" name="textoDescricao" rows="8" cols="124" id="comment" required></textarea>';
                              }
                              ?>
                        </div>
                     </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-md-3">
                        <label>Classificação: </label>
                        <?php
                           $classificacao= new ClassificacaoDAO();
                           $resultsClas  = $classificacao->localizarClassificacao();
                           echo ' <div class="form-group">
                                                   <select class="form-control" name="selectClassificacao" required>';
                           if (isset($resultsClas)) {
                           if(isset($class)){
                           echo '<option value="'.$classId.'">'.$class.'</option>';
                           }
                           	foreach ($resultsClas as $clas) {
                           if($clas->getClassificacao_Id() != $classId){
                           		echo '<option value='.$clas->getClassificacao_Id().'>'.$clas->getClassificacao_Nome().'</option>';
                           }
                           	}
                           	
                           }
                           echo '</select>';
                            ?>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <label>Gerente responsável: </label>
                     <?php
                        $gerente= new GerenteResponsavelDAO();
                        $resultsGt  = $gerente->todosGerentes();
                        echo ' <div class="form-group">
                                                <select class="form-control" name="selectGerente" required>';
                        if (isset($resultsGt)) {
                        if(isset($gp)){
                        echo '<option value="'.$gpId.'">'.$gp.'</option>';
                        }
                        	foreach ($resultsGt as $gt) {
                        if($gt->getGerenteResponsavel_Id() != $gpId){
                        		echo '<option value='.$gt->getGerenteResponsavel_Id().'>'.$gt->getGerenteResponsavel_Nome().'</option>';
                        }
                        	}
                        	
                        }
                        echo '</select>';
                         ?>
                  </div>
               </div>
               <div class="col-md-3">
                  <label>Status: </label>
                  <?php
                     $status= new StatusDAO();
                     $resultsSt  = $status->todosStatus();
                     echo ' <div class="form-group">
                                                   <select class="form-control" name="selectStatus" required>';
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
      </div>
      <div class="col-md-10">
      <button class="btn btn-success pull-right" style="margin-top:30px; margin-left:10px;" type="submit"> Salvar </button>
      </div>
      </div>
      </form>
      </div>
      </div>
   </body>
</html>