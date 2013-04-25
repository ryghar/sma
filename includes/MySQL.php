<?php 
require_once 'HandlerBDInterface.php'; 
require_once 'constantes.php'; 

class MySQL implements HandlerBDInterface 
{ 
	const USUARIO = DBUser; 
	const CLAVE = DBPass; 
	const BASE = DBMain; 
	const SERVIDOR = DBHost; 
	
	private $_conexion; 
	public function conectar() 
	{ 
		@$this->_conexion = mysql_connect( self::SERVIDOR, self::USUARIO, self::CLAVE );
		if(!$this->_conexion){throw new Exception('Could not connect: ' . mysql_error());}
		mysql_select_db( self::BASE, $this->_conexion );
	} 
	
	public function desconectar() 
	{ 
		mysql_close($this->_conexion); 
	} 
	
	public function consultar(Sql $sql) 
	{
		@$resultado = mysql_query($sql, $this->_conexion); 
		if(!$resultado){throw new Exception('Error en la consulta: ' . mysql_error());}
		while ($fila = mysql_fetch_array($resultado, MYSQL_ASSOC)){ 
			$todo[] = $fila;
		}
		if(!isset($todo)){$todo[]=0;}
		return $todo;
	}
	
	public function modificar(Sql $sql) 
	{ 
		@$resultado = mysql_query($sql, $this->_conexion); 
		if(!$resultado){throw new Exception('Error en la consulta: ' . mysql_error());}
		@$lastid = mysql_insert_id(); 
		return $lastid;
	}
	
	public function ultimoId() 
	{ 
		@$resultado = mysql_insert_id(); 
		return $resultado;
	}
}