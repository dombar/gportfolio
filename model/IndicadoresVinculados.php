<?php
Class IndicadoresVinculados{

    private $indicadores_Id;
    private $indicadores_IdProjeto;
	private $indicadores_Indicador;

    
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
	
	 public function getIndicadores_Indicador()
    {
        return $this->indicadores_Indicador;
    }
    
    public function setIndicadores_Indicador($indicadores_Indicador)
    {
        
        return $this->indicadores_Indicador = $indicadores_Indicador;
    }
	
}
?>