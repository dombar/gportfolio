<?php
class Usuario {

	private $usuario_Id;
	private $usuario_Nome;
	private $usuario_Email;
	private $usuario_Senha;
	private $usuario_Cargo;
	private $usuario_Telefone;
	private $usuario_Perfil;

	public function getUsuario_Id() {
		return $this->usuario_Id;
	}

	public function setUsuario_Id($usuario_Id) {
		return $this->usuario_Id = $usuario_Id;
	}
	
	public function getUsuario_Perfil() {
		return $this->usuario_Perfil;
	}

	public function setUsuario_Perfil($usuario_Perfil) {
		 return $this->usuario_Perfil = $usuario_Perfil;
	}
	
	public function getUsuario_Nome() {
		return $this->usuario_Nome;
	}

	public function setUsuario_Nome($usuario_Nome) {
		 return $this->usuario_Nome = $usuario_Nome;
	}

	public function getUsuario_Telefone() {
		return $this->usuario_Telefone;
	}

	public function setUsuario_Telefone($usuario_Telefone) {
		 return $this->usuario_Telefone = $usuario_Telefone;
	}
	
	public function getUsuario_Email() {
		return $this->usuario_Email;
	}

	public function setUsuario_Email($usuario_Email) {
		return $this->usuario_Email = $usuario_Email;
	}
	
	public function getUsuario_Senha() {
		return $this->usuario_Senha;
	}

	public function setUsuario_Senha($usuario_Senha) {
		return $this->usuario_Senha = $usuario_Senha;
	}

	public function getUsuario_Cargo() {
		return $this->usuario_Cargo;
	}

	public function setUsuario_Cargo($usuario_Cargo) {
		return $this->usuario_Cargo = $usuario_Cargo;
	}
}
?>