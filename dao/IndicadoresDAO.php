<?php

include_once('../dao/conexao.php');
include_once('../model/IndicadoresNome.php');
include_once('../model/IndicadoresProjeto.php');

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

	public function editarIndicador($idIndicador, $nome){
		 $sql = 'UPDATE indicadores_nome SET indicador=(:nome) WHERE id=(:id)';
		 $update = Conexao::getConnMysql()->prepare($sql);
		 $update->bindValue(":nome", $nome);
		 $update->bindValue(":id", $idIndicador);
		 return $update->execute();
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

	public function detalheIndicadoresRelatorio($idProjeto){
		$sql = 'SELECT iv.valorMax as max, iv.valorMin as min, inn.indicador as nome, inn.id as id, pj.id as idProjeto, pj.nome as nomeProjeto 
		 FROM indicadores_nome as inn 
		 JOIN indicadores_vinculados as iv on (inn.id = iv.idIndicador)
		 JOIN projetos as pj on (pj.id = iv.idProjeto)
		 WHERE iv.idProjeto = (:idProjeto)';
		$select = Conexao::getConnMysql()->prepare($sql);
		$select->bindValue(":idProjeto", $idProjeto);
		$select->execute();
		return $this->processIndicadoresRelatorio($select);
	}

	private function processIndicadoresRelatorio($statement) {
		$results = array();
		if($statement) {
			while($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$indicadoresNome = new IndicadoresProjeto();
				$indicadoresNome->setIndicadores_Id($row->id);
				$indicadoresNome->setIndicadores_Nome($row->nome);
				$indicadoresNome->setIndicadores_Valormax($row->max);
				$indicadoresNome->setIndicadores_Valormin($row->min);
				$indicadoresNome->setIndicadores_Nomeprojeto($row->nomeProjeto);
				$indicadoresNome->setIndicadores_Idprojeto($row->idProjeto);
				$results[] = $indicadoresNome;
			}
		}
		return $results;
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