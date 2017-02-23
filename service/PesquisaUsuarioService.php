<?php
session_start();
include_once('../dao/UsuarioDAO.php');

if(isset($_GET)){
	if(isset($_GET['codigo'])){
		$codigo = htmlspecialchars($_GET['codigo']);
	}
	if(isset($_GET['nome'])){
		$nome = htmlspecialchars($_GET['nome']);
	}
	if(isset($_GET['editar'])){
		$editar = htmlspecialchars($_GET['editar']);
	}
	$dao = new UsuarioDAO();
	$res = array();
	if(empty($editar)){
		$results = $dao -> localizarUsuarioPorCodigoOuNome($codigo, $nome);
		foreach($results as $v) {
			$result['codigo'] =  $v -> getUsuario_Id();
			$result['nome'] =  $v-> getUsuario_Nome();
			array_push($res, $result);
		}
		if(!empty($res)){
			$_SESSION['controlUsuario'] = 2;
			$_SESSION['listaUsuarios'] = $res;
			unset($_GET);
			return true;
		}
	}else{
		$results = $dao -> localizarUsuarioPorCodigo($editar);
		if(!empty($results)){
			$result['codigo'] =  $results -> getUsuario_Id();
			$result['nome'] =  $results-> getUsuario_Nome();
            $result['email'] = $results -> getUsuario_Email();
			$result['cargo'] = $results -> getUsuario_Cargo();
			$result['telefone'] = $results -> getUsuario_Telefone();
			$result['perfil'] = $results -> getUsuario_Perfil();
			array_push($res, $result);
			$_SESSION['usuarioEditar'] = $res;
			unset($_GET);
			return true;
	}
	}
}
?>