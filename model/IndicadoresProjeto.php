<?php
Class IndicadoresProjeto{

    private $indicadores_Id;
    private $indicadores_IdProjeto;
	private $indicadores_Valormax;
	private $indicadores_Valormin;
    
    public function getIndicadores_Id()
    {
        return $this->indicadores_Id;
    }
    
    public function setIndicadores_Id($indicadores_Id)
    {
        return $this->indicadores_Id = $indicadores_Id;
    }
    
    public function getIndicadores_IdProjeto()
    {
        return $this->indicadores_IdProjeto;
    }
    
    public function setIndicadores_IdProjeto($indicadores_IdProjeto)
    {
        
        return $this->indicadores_IdProjeto = $indicadores_IdProjeto;
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