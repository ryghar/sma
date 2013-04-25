<?php
require_once 'BaseDeDatos.php'; 
require_once 'MySQL.php'; 
require_once 'Sql.php';
require_once('constantes.php');
require_once('idioma.php');

$result = array();

try{
	$bd = new BaseDeDatos(new MySQL()); 
	$sql = new Sql();  
		
	$consulta = "select * from ads_countries order by ".SELECT_TEXTO_PAIS;
	$sql->generar($consulta);
	$res = $bd->ejecutar($sql);
		
	$items = array();
	foreach($res as $key=>$value){
		array_push($items, $value);
	}
}catch(Exception $e){
	echo 'Error: '.$e->getMessage();
}
echo json_encode($items);

?>