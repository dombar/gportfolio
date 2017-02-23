<?php
include_once('../dao/conexao.php');
include_once('../model/Status.php');

class StatusDAO{

	public static function getConnMysql() { 
		if (!isset(self::$instance)){
			self::$instance = new StatusDAO();
			return self::$instance; 
		}
	}
	
	public function todosStatus(){
		$query = Conexao::getConnMysql()->prepare('SELECT * FROM status ORDER BY nome');
		$query->execute();
		return $this->processResults($query);
	}
	
	public function getStatusPorId($idStatus){
		$query = Conexao::getConnMysql()->prepare('SELECT * FROM status WHERE id = (:idStatus)');
		$query->bindValue(":idStatus", $idStatus);
		$query->execute();
		return $this->processResult($query);
	}
	
	public function salvarAlteracaoStatus($idStatus, $idUsuario){
		$insert = Conexao::getConnMysql()->prepare('INSERT INTO status_alteracao (idStatus, idUsuario, data) VALUES (:idStatus,:idUsuario,:data)');
		$insert->bindValue(":idStatus", $idStatus);
		$insert->bindValue(":idUsuario", $idUsuario);
		$insert->bindValue(":data", date("Y-m-d H:i:s"));
		$insert->execute();
	}
	
	private function processResult($statement) {
		if($statement) {
			while($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$status = new Status();
				$status->setStatus_Id($row->id);
				$status->setStatus_Nome($row->nome);
				return $status;
			}
		}
	}
	
	private function processResults($statement) {
		$results = array();

		if($statement) {
			while($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$status = new Status();
				$status->setStatus_Id($row->id);
				$status->setStatus_Nome($row->nome);
				$results[] = $status;
			}
		}

		return $results;
	}
}
?>