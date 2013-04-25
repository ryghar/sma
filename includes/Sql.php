<?php 

class Sql 
{ 
	private $_consulta; 
	public function generar($consulta) 
	{ 
		$this->_consulta=$consulta;
		return $this->_consulta; 
	} 
	
	public function __toString() 
	{ 
		return $this->generar($this->_consulta); 
	} 
}