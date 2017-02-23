<?php

Class Justificativa_Status{

    private $jst_Id;
    private $jst_Justificativa;
    private $jst_IdProjeto;

    public function getJst_Id()
    {
        return $this->jst_Id;
    }
    
    public function setJst_Id($jst_Id)
    {
        return $this->jst_Id = $jst_Id;
    }

    public function getJst_Justificativa()
    {
        return $this->jst_Justificativa;
    }
    
    public function setJst_Justificativa($jst_Justificativa)
    {
        return $this->jst_Justificativa = $jst_Justificativa;
    }

    public function getJst_idProjeto()
    {
        return $this->jst_IdProjeto;
    }
    
    public function setJst_idProjeto($jst_IdProjeto)
    {
        return $this->jst_IdProjeto = $jst_IdProjeto;
    }

}
?>