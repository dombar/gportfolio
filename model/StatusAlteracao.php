<?php

Class StatusAlteracao{
	
	private $sa_id;
	private $sa_idUsuario;
	private $sa_idStatus;
	private $sa_data;
	
	public function getSa_id()
    {
        return $this->sa_id;
    }
    
    public function setSa_id($sa_id)
    {
        return $this->sa_id = $sa_id;
    }
	
	public function getSa_idUsuario()
    {
        return $this->sa_idUsuario;
    }
    
    public function setSa_idUsuario($sa_idUsuario)
    {
        return $this->sa_idUsuario = $sa_idUsuario;
    }
	
	public function getSa_idStatus()
    {
        return $this->sa_idStatus;
    }
    
    public function setSa_idStatus($sa_idStatus)
    {
        return $this->sa_idStatus = $sa_idStatus;
    }
	
	public function getSa_data()
    {
        return $this->sa_data;
    }
    
    public function setSa_data($sa_data)
    {
        return $this->sa_data = $sa_data;
    }
}

?>