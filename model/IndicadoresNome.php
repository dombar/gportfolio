<?php
Class IndicadoresNome{

    private $indicadores_Id;
    private $indicadores_Nome;
    
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
}
?>