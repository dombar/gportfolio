<?php
Class IndicadoresProjeto{

    private $indicadores_Id;
    private $indicadores_Nome;
	private $indicadores_Valormax;
	private $indicadores_Valormin;
    private $indicadores_Nomeprojeto;
    private $indicadores_Idprojeto;

    public function getIndicadores_Nomeprojeto()
    {
        return $this->indicadores_Nomeprojeto;
    }
    
    public function setIndicadores_Nomeprojeto($indicadores_Nomeprojeto)
    {
        return $this->indicadores_Nomeprojeto = $indicadores_Nomeprojeto;
    }

     public function getIndicadores_Idprojeto()
    {
        return $this->indicadores_Idprojeto;
    }
    
    public function setIndicadores_Idprojeto($indicadores_Idprojeto)
    {
        return $this->indicadores_Idprojeto = $indicadores_Idprojeto;
    }

    public function getIndicadores_Id()
    {
        return $this->indicadores_Id;
    }
    
    public function setIndicadores_Id($indicadores_Id)
    {
        return $this->indicadores_Id = $indicadores_Id;
    }
    
    public function getIndicadores_Nome()
    {
        return $this->indicadores_Nome;
    }
    
    public function setIndicadores_Nome($indicadores_Nome)
    {
        
        return $this->indicadores_Nome = $indicadores_Nome;
    }
	
	 public function getIndicadores_Valormax()
    {
        return $this->indicadores_Valormax;
    }
    
    public function setIndicadores_Valormax($indicadores_Valormax)
    {
        
        return $this->indicadores_Valormax = $indicadores_Valormax;
    }
	
	 public function getIndicadores_Valormin()
    {
        return $this->indicadores_Valormin;
    }
    
    public function setIndicadores_Valormin($indicadores_Valormin)
    {
        
        return $this->indicadores_Valormin = $indicadores_Valormin;
    }
}
?>