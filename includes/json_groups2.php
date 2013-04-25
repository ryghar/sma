<?php
require_once 'BaseDeDatos.php'; 
require_once 'MySQL.php'; 
require_once 'Sql.php';
require_once('constantes.php');
require_once('idioma.php');

$result = array();
if(isset($_GET['idgroup'])){
$idgroup
try{
	$bd = new BaseDeDatos(new MySQL()); 
	$sql = new Sql();  
		
	$consulta = "select name, description,status from ssv_groups where id_group=11";
	$sql->generar($consulta);
	$res = $bd->ejecutar($sql);
		
	$items = array();
	foreach($res as $key=>$value){
		array_push($items, $value);
	}
}catch(Exception $e){
	echo 'Error: '.$e->getMessage();
}

$items=json_encode($items);
$items=substr($items,1,-1);
echo $items;

?>