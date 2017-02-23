<?php

class Conexao{

	public static $instance; 

	public static function getConnMysql() { 
	
	$servidor='127.0.0.1';
	$porta = 3306;
	$dbName='gerenciador_portfolio';
	$usuario = "root";
	$senha = "";
	try{
		if (!isset(self::$instance)) { 
			self::$instance = new PDO("mysql:host=$servidor;port=$porta;dbname=$dbName;charset=utf8", $usuario, $senha); 
		}
		return self::$instance;
	}catch(Exception $e){
		echo 'ERRO AO CONECTAR NO BANCO DE DADOS.';
		#echo $e;
		return false;
	}
	}	
}
	
?>