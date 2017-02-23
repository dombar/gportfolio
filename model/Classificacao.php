<?php
Class classificacao{

    private $classificacao_Id;
    private $classificacao_Nome;
    
    public function getClassificacao_Id()
    {
        return $this->classificacao_Id;
    }
    
    public function setClassificacao_Id($classificacao_Id)
    {
        return $this->classificacao_Id = $classificacao_Id;
    }
    
    public function getClassificacao_Nome()
    {
        return $this->classificacao_Nome;
    }
    
    public function setClassificacao_Nome($classificacao_Nome)
    {
        
        return $this->classificacao_Nome = $classificacao_Nome;
    }
}
?>