<?php 

interface HandlerBDInterface 
{ 
	public function conectar(); 
	public function desconectar(); 
	public function consultar(Sql $sql); 
}