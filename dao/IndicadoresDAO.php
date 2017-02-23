<?php

include_once('../dao/conexao.php');
include_once('../model/IndicadoresNome.php');

class IndicadoresDAO{
	
	public static function getConnMysql() { 
		if (!isset(self::$instance)){
			self::$instance = new IndicadoresDAO();
			return self::$instance; 
		}
	}
	
	public function pesquisaIndicadores($nome, $idIndicador){
		if (!empty($nome)) {
            $query = Conexao::getConnMysql()->prepare('SELECT * FROM indicadores_nome WHERE indicador LIKE (:nome)');
            $query->bindValue(':nome', '%' . $nome . '%');
		}else if(!empty($idIndicador)){
			$query = Conexao::getConnMysql()->prepare('SELECT * FROM indicadores_nome WHERE id = (:idIndicador)');
			$query->bindValue(':idIndicador', $idIndicador);
		}else{
			$query = Conexao::getConnMysql()->prepare('SELECT * FROM indicadores_nome ORDER BY indicador');
		}
		$query -> execute();
		return $this->processIndicadoresNome($query);
	}
	
	public function inserirIndicadores($nome){
		try{
			$sql = 'INSERT INTO indicadores_nome(indicador) VALUES (:nome)';
			$insert = Conexao::getConnMysql()->prepare($sql);
			$insert->bindValue(":nome", $nome);
			return $insert->execute();
		}catch(Exception $e){
			print "Erro ao tentar inserir um indicador" . $e->getMessage();
			return false;
		}
	}
	
	public function inserirIndicadoresAoProjeto($indicadores, $idProjeto, $valorMax, $valorMin){
		try{
			foreach ($indicadores as $m){
				$query = Conexao::getConnMysql()->prepare('SELECT * FROM indicadores_nome WHERE indicador = (:nome)');
				$query->bindValue(":nome", $m);
				 $query->execute();
				$idIndicador = $this->processIndicadoresNome($query);
				if(!empty($idIndicador)){
					foreach ($idIndicador as $g){
						$sql = 'INSERT INTO indicadores_vinculados(idIndicador, idProjeto, valorMax, valorMin) VALUES (:idIndicador, :idProjeto, :valorMax, :valorMin)';
						$insert = Conexao::getConnMysql()->prepare($sql);
						$insert->bindValue(":idIndicador", $g->getIndicadores_Id());
						$insert->bindValue(":idProjeto", $idProjeto);
						$insert->bindValue(":valorMax", $valorMax);
						$insert->bindValue(":valorMin", $valorMin);
						$insert->execute();
					}
				}
			}
		}catch(Exception $e){
			print "Erro ao tentar inserir um indicador" . $e->getMessage();
			return false;
		}
	}
	
	public function pesquisaIndicadoresVinculados($idProjeto){
		try{
			$sql = 'SELECT * FROM indicadores_vinculados as iv join indicadores_nome as n on (n.id = iv.idIndicador) WHERE iv.idProjeto = (:idProjeto)';
			$select = Conexao::getConnMysql()->prepare($sql);
			$select->bindValue(":idProjeto", $idProjeto);
			$select->execute();
			return $this->processIndicadoresNome($select);
		}catch(Exception $e){
			print "Erro ao tentar pesquisar um indicador" . $e->getMessage();
			return false;
		}
	}
	
	public function pesquisaTodosIndicadores($idProjeto){
		try{
			$sql = 'SELECT * FROM indicadores_nome i where i.id not in (select iv.idIndicador from indicadores_vinculados iv where iv.idProjeto = (:idProjeto))';
			$select = Conexao::getConnMysql()->prepare($sql);
			$select->bindValue(":idProjeto", $idProjeto);
			$select->execute();
			return $this->processIndicadoresNome($select);
		}catch(Exception $e){
			print "Erro ao tentar pesquisar um indicador" . $e->getMessage();
			return false;
		}
	}

	public function deletarIndicador($idIndicador){
		try{
			$delete = 'DELETE FROM indicadores_vinculados WHERE idIndicador = (:idIndicador)';
			$selectF = Conexao::getConnMysql()->prepare($delete);
			$selectF->bindValue(":idIndicador", $idIndicador);
			$selectF->execute();

			$deleteIndicador = 'DELETE FROM indicadores_nome WHERE id = (:idIndicador)';
			$selectL = Conexao::getConnMysql()->prepare($deleteIndicador);
			$selectL->bindValue(":idIndicador", $idIndicador);
			$selectL->execute();
		}catch(Exception $e){
			print "Erro ao tentar pesquisar um indicador" . $e->getMessage();
			return false;
		}
	}

	public function deletarIndicadorProjeto($idIndicador, $idProjeto){
		try{
			$delete = 'DELETE FROM indicadores_vinculados WHERE idIndicador = (:idIndicador) AND idProjeto =(:idProjeto)';
			$selectF = Conexao::getConnMysql()->prepare($delete);
			$selectF->bindValue(":idIndicador", $idIndicador);
			$selectF->bindValue(":idProjeto", $idProjeto);
			$selectF->execute();
		}catch(Exception $e){
			print "Erro ao tentar pesquisar um indicador" . $e->getMessage();
			return false;
		}
	}
	
	private function processIndicadoresNome($statement) {
		$results = array();
		if($statement) {
			while($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$indicadoresNome = new IndicadoresNome();
				$indicadoresNome->setIndicadores_Id($row->id);
				$indicadoresNome->setIndicadores_Nome($row->indicador);
				$results[] = $indicadoresNome;
			}
		}
		return $results;
	}
}

?>