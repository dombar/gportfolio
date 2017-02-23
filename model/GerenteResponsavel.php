<?php
Class GerenteResponsavel{
    
    private $gerenteResponsavel_Id;
    private $gerenteResponsavel_Nome;
    
    public function getGerenteResponsavel_Id()
    {
        return $this->gerenteResponsavel_Id;
    }
    
    public function setGerenteResponsavel_Id($gerenteResponsavel_Id)
    {
        return $this->gerenteResponsavel_Id = $gerenteResponsavel_Id;
    }
    
    public function getGerenteResponsavel_Nome()
    {
        return $this->gerenteResponsavel_Nome;
    }
    
    public function setGerenteResponsavel_Nome($gerenteResponsavel_Nome)
    {
        
        return $this->gerenteResponsavel_Nome = $gerenteResponsavel_Nome;
    }
}
?>