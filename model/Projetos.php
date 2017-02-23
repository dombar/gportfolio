<?php
Class Projetos{

    private $projeto_Id;
    private $projeto_Nome;
    private $projeto_Orcamento_total;
    private $projeto_Descricao;
    private $projeto_Data_termino;
    private $projeto_Data_inicio;
    private $projeto_Data_termino_real;
    private $projeto_Classificacao;
    private $projeto_Gerente_responsavel;
    private $projeto_Status;
	private $projeto_IdST;
	private $projeto_IdCL;
	private $projeto_IdGP;
	
	 public function getProjeto_IdST()
    {
        return $this->projeto_IdST;
    }
    
    public function setProjeto_IdST($projeto_IdST)
    {
        return $this->projeto_IdST = $projeto_IdST;
    }
    
	 public function getProjeto_IdCL()
    {
        return $this->projeto_IdCL;
    }
    
    public function setProjeto_IdCL($projeto_IdCL)
    {
        return $this->projeto_IdCL = $projeto_IdCL;
    }
	
	public function getProjeto_IdGP()
    {
        return $this->projeto_IdGP;
    }
    
    public function setProjeto_IdGP($projeto_IdGP)
    {
        return $this->projeto_IdGP = $projeto_IdGP;
    }
	
	
    public function getProjeto_Id()
    {
        return $this->projeto_Id;
    }
    
    public function setProjeto_Id($projeto_Id)
    {
        return $this->projeto_Id = $projeto_Id;
    }
    
    public function getProjeto_Nome()
    {
        return $this->projeto_Nome;
    }
    
    public function setProjeto_Nome($projeto_Nome)
    {
        
        return $this->projeto_Nome = $projeto_Nome;
    }
    
    public function getProjeto_Orcamento_total()
    {
        return $this->projeto_Orcamento_total;
    }
    
    public function setProjeto_Orcamento_total($projeto_Orcamento_total)
    {
        
        return $this->projeto_Orcamento_total = $projeto_Orcamento_total;
    }
    
    public function getProjeto_Descricao()
    {
        return $this->projeto_Descricao;
    }
    
    public function setProjeto_Descricao($projeto_Descricao)
    {
        
        return $this->projeto_Descricao = $projeto_Descricao;
    }
    
    public function getProjeto_Data_termino()
    {
        return $this->projeto_Data_termino;
    }
    
    public function setProjeto_Data_termino($projeto_Data_termino)
    {
        
        return $this->projeto_Data_termino = $projeto_Data_termino;
    }
    
    public function getProjeto_Data_inicio()
    {
        return $this->projeto_Data_inicio;
    }
    
    public function setProjeto_Data_inicio($projeto_Data_inicio)
    {
        
        return $this->projeto_Data_inicio = $projeto_Data_inicio;
    }
    
    public function getProjeto_Data_termino_real()
    {
        return $this->projeto_Data_termino_real;
    }
    
    public function setProjeto_Data_termino_real($projeto_Data_termino_real)
    {
        
        return $this->projeto_Data_termino_real = $projeto_Data_termino_real;
    }
    
    public function getProjeto_Classificacao()
    {
        return $this->projeto_Classificacao;
    }
    
    public function setProjeto_Classificacao($projeto_Classificacao)
    {
        
        return $this->projeto_Classificacao = $projeto_Classificacao;
    }
    
    public function getProjeto_Gerente_responsavel()
    {
        return $this->projeto_Gerente_responsavel;
    }
    
    public function setProjeto_Gerente_responsavel($projeto_Gerente_responsavel)
    {
        
        return $this->projeto_Gerente_responsavel = $projeto_Gerente_responsavel;
    }
    
    public function getProjeto_Status()
    {
        return $this->projeto_Status;
    }
    
    public function setProjeto_Status($projeto_Status)
    {
        
        return $this->projeto_Status = $projeto_Status;
    }
}
?>