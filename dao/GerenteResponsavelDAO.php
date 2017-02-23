<?php
include_once('../dao/conexao.php');
include_once('../model/GerenteResponsavel.php');

class GerenteResponsavelDAO{

	public static function getConnMysql() { 
		if (!isset(self::$instance)){
			self::$instance = new GerenteResponsavelDAO();
			return self::$instance; 
		}
	}
	
	public function todosGerentes(){
		$query = Conexao::getConnMysql()->prepare('SELECT * FROM gerente_responsavel ORDER BY nome');
		$query->execute();
		return $this->processResults($query);
	}
	
	
	private function processResult($statement) {
		if($statement) {
			while($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$gerente = new GerenteResponsavel();
				$gerente->setGerente_responsavel_Id($row->id);
				$gerente->setGerente_responsavel_Nome($row->nome);
				return $gerente;
			}
		}
	}
	
	private function processResults($statement) {
		$results = array();

		if($statement) {
			while($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$gerente = new GerenteResponsavel();
				$gerente->setGerenteResponsavel_Id($row->id);
				$gerente->setGerenteResponsavel_Nome($row->nome);
				$results[] = $gerente;
			}
		}

		return $results;
	}
}
?>