<?php
Class Permissao{
    
    private $permissao_Id;
    private $permissao_Nome;
    
    public function getPermissao_Id()
    {
        return $this->permissao_Id;
    }
    
    public function setPermissao_Id($permissao_Id)
    {
        return $this->permissao_Id = $permissao_Id;
    }
    
    public function getPermissao_Nome()
    {
        return $this->permissao_Nome;
    }
    
    public function setPermissao_Nome($permissao_Nome)
    {
        return $this->permissao_Nome = $permissao_Nome;
    }
}
?>