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
	$consulta = "select count(*) from ssv_groups";
	$sql->generar($consulta);
	$res = $bd->ejecutar($sql);
	$result["total"] = $res[0];
		
	$consulta = "select * from ssv_groups";
	$sql->generar($consulta);
	$res = $bd->ejecutar($sql);
		
	$items = array();
	foreach($res as $key=>$value){
		array_push($items, $value);
	}
}catch(Exception $e){
	echo 'Error: '.$e->getMessage();
}
$result["rows"] = $items;
echo json_encode($items);

?>