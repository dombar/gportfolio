<?php
Class FormatDataMysql{

	public function formataData($data){
                        $dateString = str_replace("/","",$data);
                        $dd = substr($dateString,0,2);
                        $mm = substr($dateString,2,2);
                        $yy = substr($dateString,4,4);
						$dataGravar = $yy."-".$mm."-".$dd;
						return $dataGravar;
						
	}
	
	public function formataDataApresentacao($data){
                        $dateString = str_replace("-","",$data);
                        $dd = substr($dateString,0,2);
                        $mm = substr($dateString,2,2);
                        $yy = substr($dateString,4,4);
						$dataGravar = $dd."-".$mm."-".$yy;
						return $dataGravar;
						
	}
}
?>