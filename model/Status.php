<?php
Class Status{
    
    private $status_Id;
    private $status_Nome;
    
    public function getStatus_Id()
    {
        return $this->status_Id;
    }
    
    public function setStatus_Id($status_Id)
    {
        return $this->status_Id = $status_Id;
    }
    
    public function getStatus_Nome()
    {
        return $this->status_Nome;
    }
    
    public function setStatus_Nome($status_Nome)
    {
        
        return $this->status_Nome = $status_Nome;
    }
}
?>