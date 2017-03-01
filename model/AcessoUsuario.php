<?php

Class AcessoUsuario{

	private $editar_usuario;
	private $excluir_usuario;
	private $editar_permissao_usuario;
	private $cadastrar_usuario;
	private $cadastrar_projeto;
	private $editar_projeto;
	private $excluir_projeto;
	private $editar_status_projeto;
	private $editar_membros_projeto;
	private $editar_indicadores_projeto;
    private $relatorio_indicadores;
	
	public function acessoUsuario(){
		include_once('../dao/UsuarioDAO.php');
		$userId = null;
		if (isset($_COOKIE['userId'])) {
			$userId = $_COOKIE['userId'];
		} else {
			$userId = $_SESSION['usuarioLogado'];
		}
		$daoUser   = new UsuarioDAO();
		$permissao = $daoUser->consultaModulosUsuario($userId);
		foreach ($permissao as $m) {
			if ($m->getPermissao_Nome() == 'Cadastro de projetos') {
				$this -> setCadastrar_projeto(true);
			}
			if ($m->getPermissao_Nome() == 'Editar projeto') {
				$this -> setEditar_projeto(true);
			}
			if($m -> getPermissao_Nome() == 'Editar status projeto'){
				$this -> setEditar_status_projeto(true);
			}
			if($m -> getPermissao_Nome() == 'Editar indicadores projeto'){
				$this -> setEditar_indicadores_projeto(true);
			}
			if($m -> getPermissao_Nome() == 'Editar membros projeto'){
				$this -> setEditar_membros_projeto(true);
			}
			if($m -> getPermissao_Nome() == 'Excluir projeto'){
				$this -> setExcluir_projeto(true);
			}
			if($m -> getPermissao_Nome() == 'Excluir usuario'){
				$this -> setExcluir_usuario(true);
			}
			if($m -> getPermissao_Nome() == 'Editar usuario'){
				$this -> setEditar_usuario(true);
			}
			if($m -> getPermissao_Nome() == 'Editar permissao usuario'){
				$this -> setEditar_permissao_usuario(true);
			}
			if($m -> getPermissao_Nome() == 'Cadastro de usuário'){
				$this -> setCadastrar_usuario(true);
			}
            if($m -> getPermissao_Nome() == 'Relatório indicadores'){
				$this -> setRelatorio_indicadores(true);
			}
		}
		
		return $this;
	}
	
	
	public function getEditar_usuario()
    {
        return $this->editar_usuario;
    }
    
    public function setEditar_usuario($editar_usuario)
    {
        return $this->editar_usuario = $editar_usuario;
    }

    public function getRelatorio_indicadores()
    {
        return $this->relatorio_indicadores;
    }
    
    public function setRelatorio_indicadores($relatorio_indicadores)
    {
        return $this->relatorio_indicadores = $relatorio_indicadores;
    }

	public function getExcluir_usuario()
    {
        return $this->excluir_usuario;
    }
    
    public function setExcluir_usuario($excluir_usuario)
    {
        return $this->excluir_usuario = $excluir_usuario;
    }
	
	public function getEditar_permissao_usuario()
    {
        return $this->editar_permissao_usuario;
    }
    
    public function setEditar_permissao_usuario($editar_permissao_usuario)
    {
        return $this->editar_permissao_usuario = $editar_permissao_usuario;
    }
	
	public function getCadastrar_usuario()
    {
        return $this->cadastrar_usuario;
    }
    
    public function setCadastrar_usuario($cadastrar_usuario)
    {
        return $this->cadastrar_usuario = $cadastrar_usuario;
    }
	
	public function getCadastrar_projeto()
    {
        return $this->cadastrar_projeto;
    }
    
    public function setCadastrar_projeto($cadastrar_projeto)
    {
        return $this->cadastrar_projeto = $cadastrar_projeto;
    }
	
	public function getEditar_projeto()
    {
        return $this->editar_projeto;
    }
    
    public function setEditar_projeto($editar_projeto)
    {
        return $this->editar_projeto = $editar_projeto;
    }
	
	public function getExcluir_projeto()
    {
        return $this->excluir_projeto;
    }
    
    public function setExcluir_projeto($excluir_projeto)
    {
        return $this->excluir_projeto = $excluir_projeto;
    }
	
	public function getEditar_status_projeto()
    {
        return $this->editar_status_projeto;
    }
    
    public function setEditar_status_projeto($editar_status_projeto)
    {
        return $this->editar_status_projeto = $editar_status_projeto;
    }
	
	public function getEditar_membros_projeto()
    {
        return $this->editar_membros_projeto;
    }
    
    public function setEditar_membros_projeto($editar_membros_projeto)
    {
        return $this->editar_membros_projeto = $editar_membros_projeto;
    }
	
	public function getEditar_indicadores_projeto()
    {
        return $this->editar_indicadores_projeto;
    }
    
    public function setEditar_indicadores_projeto($editar_indicadores_projeto)
    {
        return $this->editar_indicadores_projeto = $editar_indicadores_projeto;
    }
	

}

?>