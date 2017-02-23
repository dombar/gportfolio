<?php
include_once('../dao/conexao.php');
include_once('../model/Classificacao.php');

class ClassificacaoDAO{

	public static function getConnMysql() { 
		if (!isset(self::$instance)){
			self::$instance = new ClassificacaoDAO();
			return self::$instance; 
		}
	}
	
	public function localizarClassificacao(){
		$query = Conexao::getConnMysql()->prepare('SELECT * FROM classificacao');
		$query->execute();
		return $this->processResults($query);
	}
	
	
	private function processResult($statement) {
		if($statement) {
			while($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$classificacao = new Classificacao();
				$classificacao->setClassificacao_Id($row->id);
				$classificacao->setClassificacao_Nome($row->nome);
				return $classificacao;
			}
		}
	}
	
	private function processResults($statement) {
		$results = array();

		if($statement) {
			while($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$classificacao = new Classificacao();
				$classificacao->setClassificacao_Id($row->id);
				$classificacao->setClassificacao_Nome($row->nome);
				$results[] = $classificacao;
			}
		}

		return $results;
	}
}
?>