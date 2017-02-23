<?php
include_once('../dao/conexao.php');
include_once('../model/Usuario.php');
include_once('../model/Permissao.php');

class UsuarioDAO{

	public static function getConnMysql() { 
		if (!isset(self::$instance)){
			self::$instance = new UsuarioDAO();
			return self::$instance; 
		}
	}

	public function todosUsuarios() {
		$query = Conexao::getConnMysql()->prepare('SELECT * FROM usuarios ORDER BY nome');
		$query->execute();
		return $this->processResults($query);
	}
	
	public function todosMembrosProjeto($idProjeto) {
		$query = Conexao::getConnMysql()->prepare('SELECT us.* FROM usuarios as us JOIN membros as mb on (us.id = mb.idUsuario) WHERE mb.idProjeto=:idProjeto');
		$query->bindValue(":idProjeto", $idProjeto);
		$query->execute();
		return $this->processResults($query);
	}
	
	public function todosMembrosForaDoProjeto($idProjeto){
		$query = Conexao::getConnMysql()->prepare('select * from usuarios us where us.id not in (select m.idUsuario from membros as m where m.idProjeto = (:idProjeto))');
		$query->bindValue(":idProjeto", $idProjeto);
		$query->execute();
		return $this->processResults($query);
	}
	
	public function deletarMembrosDoProjeto($idProjeto, $idUsuario){
		$query = Conexao::getConnMysql()->prepare('DELETE FROM membros WHERE idProjeto= (:idProjeto) AND idUsuario = (:idUsuario)');
		$query->bindValue(":idProjeto", $idProjeto);
		$query->bindValue(":idUsuario", $idUsuario);
		$query->execute();
	}
	
	public function vincularMembrosProjeto($membros, $idProjeto){
		foreach ($membros as $m){
			$query = Conexao::getConnMysql()->prepare('SELECT * from usuarios as us JOIN membros as mb on (mb.idUsuario = us.id) 
			WHERE us.nome = (:membros) AND mb.idProjeto = (:idProjeto)');
			$query->bindValue(":membros", $m);
			$query->bindValue(":idProjeto", $idProjeto);
			$query->execute();
			$usuarios = $this->processResults($query);
			if(empty($usuarios)){
				$queryUsuario = Conexao::getConnMysql()->prepare('SELECT * from usuarios WHERE nome = (:membros)');
				$queryUsuario->bindValue(":membros", $m);
				$queryUsuario->execute();
				$usuariosSelect = $this->processResults($queryUsuario);
				foreach($usuariosSelect as $us){
					$insert = Conexao::getConnMysql()->prepare('INSERT INTO membros (idUsuario,idProjeto) VALUES (:idUsuario, :idProjeto)');
					$insert->bindValue(":idUsuario", $us->getUsuario_Id());
					$insert->bindValue(":idProjeto", $idProjeto);
					$insert->execute();
					return $insert;
				}
			}
		}
	}

	public function validaUsuario($email, $password){
		$password = md5($password);
		$query = Conexao::getConnMysql()->prepare('SELECT * FROM usuarios WHERE senha=(:password) AND email=(:email) LIMIT 1');
		$query->bindValue(":email", $email);
		$query->bindValue(":password", $password); 
		$query->execute();
		return $this->processResults($query); 
	}

	public function localizarUsuarioPorCodigoOuNome($codigo, $nome){

		if (!empty($codigo)) {
            $query = Conexao::getConnMysql()->prepare('SELECT * FROM usuarios WHERE id=(:codigo)');
            $query->bindValue(":codigo", $codigo, PDO::PARAM_INT);
        } else if (!empty($nome)) {
            $query = Conexao::getConnMysql()->prepare('SELECT * FROM usuarios WHERE nome LIKE nome=(:nome)');
            $query->bindValue(':nome', '%' . $nome . '%');
        } else {
            $query = Conexao::getConnMysql()->prepare('SELECT * FROM usuarios');
        }
        $query->execute();
        return $this->processResults($query);
	}
	
	public function localizarUsuarioPorCodigo($codigo){
        $query = Conexao::getConnMysql()->prepare('SELECT * FROM usuarios WHERE id=(:codigo)');
        $query->bindValue(":codigo", $codigo, PDO::PARAM_INT);
        $query->execute();
        return $this->processResult($query);
	}
	
	public function validaUsuarioPorEmail($email){
		$query = Conexao::getConnMysql()->prepare('SELECT * FROM usuarios WHERE email=(:email) LIMIT 1');
		$query->bindValue(":email", $email);
		$query->execute();
		return $this->processResult($query);
	}
	
	public function verificaModulosUsuario($idUsuario){
		$query = Conexao::getConnMysql()->prepare('select us.* from permissao us where us.id not in 
		(select m.idPermissao from permissao_usuario as m where m.idUsuario = (:idUsuario))');
		$query->bindValue(":idUsuario", $idUsuario);
		$query->execute();
		return $this->processResultPermissao($query);
	}
	
	public function consultaModulosUsuario($idUsuario){
		$query = Conexao::getConnMysql()->prepare('select pm.* from permissao_usuario as pu 
		join permissao as pm on (pm.id = pu.idPermissao)
		where pu.idUsuario = (:idUsuario)');
		$query->bindValue(":idUsuario", $idUsuario);
		$query->execute();
		return $this->processResultPermissao($query);
	}
	
	public function inserirModulosUsuario($idUsuario, $permissao){
		foreach ($permissao as $m){
			$query = Conexao::getConnMysql()->prepare('SELECT * from permissao where nome =(:pm)');
			$query->bindValue(":pm", $m);
			$query->execute();
			$usuarios = $this->processResultPermissao($query);
			if(!empty($usuarios)){
				foreach($usuarios as $us){
					$insert = Conexao::getConnMysql()->prepare('INSERT INTO permissao_usuario (idUsuario,idPermissao,permissao) VALUES (:idUsuario, :idPermissao, :permissao)');
					$insert->bindValue(":idUsuario", $idUsuario);
					$insert->bindValue(":idPermissao", $us -> getPermissao_Id());
					$insert->bindValue(":permissao", true);
					$insert->execute();
				}
			}
		}
	}

	public function removeUsuario($idUsuario){
		$deleteMembros = Conexao::getConnMysql()->prepare('DELETE FROM membros WHERE idUsuario = (:idUsuario)');
		$deleteMembros->bindValue(":idUsuario", $idUsuario);
		$deleteMembros->execute();

		$deletePermissao = Conexao::getConnMysql()->prepare('DELETE FROM permissao_usuario WHERE idUsuario = (:idUsuario)');
		$deletePermissao->bindValue(":idUsuario", $idUsuario);
		$deletePermissao->execute();

		$deleteStatus = Conexao::getConnMysql()->prepare('DELETE FROM status WHERE idUsuario = (:idUsuario)');
		$deleteStatus->bindValue(":idUsuario", $idUsuario);
		$deleteStatus->execute();

		$deleteUsuario = Conexao::getConnMysql()->prepare('DELETE FROM usuarios WHERE id = (:idUsuario)');
		$deleteUsuario->bindValue(":id", $idUsuario);
		$deleteUsuario->execute();

	}

	public function inserirUsuario(Usuario $usuario){
		try{
			$query = Conexao::getConnMysql()->prepare('SELECT * FROM usuarios WHERE email=(:email) LIMIT 1');
			$query->bindValue(":email", $usuario->getUsuario_Email());
			$query->execute();
			$us = $this->processResults($query);
			if(empty($us)){
				$senha = md5($usuario->getUsuario_Senha());
				$sql = 'INSERT INTO usuarios(email, cargo, nome, senha, telefone) 
				VALUES (:email,:cargo,:nome,:senha,:telefone)';
			
				$insert = Conexao::getConnMysql()->prepare($sql);
				$insert->bindValue(":email", $usuario->getUsuario_Email());
				$insert->bindValue(":cargo", $usuario->getUsuario_Cargo()); 
				$insert->bindValue(":nome", $usuario->getUsuario_Nome()); 
				$insert->bindValue(":senha", $senha); 
				$insert->bindValue(":telefone", $usuario->getUsuario_Telefone()); 
	
				$insert->execute();
				return 1;
			}else{
				return 3;
			}
		}catch(Exception $e){
			print "Erro ao tentar inserir um novo usuário" . $e->getMessage();
			return 2;
		}
	}
	
	private function processResultPermissao($statement) {
		$results = array();
		if($statement) {
			while($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$permissao = new Permissao();
				$permissao->setPermissao_Id($row->id);
				$permissao->setPermissao_Nome($row->nome);
				$results[] = $permissao;
			}
		}
		return $results;
	}

	private function processResult($statement) {
		if($statement) {
			while($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$usuarios = new Usuario();
				$usuarios->setUsuario_Id($row->id);
				$usuarios->setUsuario_Nome($row->nome);
				$usuarios->setUsuario_Email($row->email);
				$usuarios->setUsuario_Senha($row->senha);
				$usuarios->setUsuario_Cargo($row->cargo);
				$usuarios->setUsuario_Telefone($row->telefone);
				return $usuarios;
			}
		}
	}
	
	private function processResults($statement) {
		$results = array();

		if($statement) {
			while($row = $statement->fetch(PDO::FETCH_OBJ)) {
				$usuarios = new Usuario();
				$usuarios->setUsuario_Id($row->id);
				$usuarios->setUsuario_Nome($row->nome);
				$usuarios->setUsuario_Email($row->email);
				$usuarios->setUsuario_Senha($row->senha);
				$usuarios->setUsuario_Cargo($row->cargo);
				$usuarios->setUsuario_Telefone($row->telefone);
				$results[] = $usuarios;
			}
		}

		return $results;
	}
}

?>