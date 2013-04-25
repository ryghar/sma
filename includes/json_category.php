<?php
require_once 'BaseDeDatos.php'; 
require_once 'MySQL.php'; 
require_once 'Sql.php';
require_once('constantes.php');
require_once('idioma.php');


if(isset($_GET['id'])){$filter=' where rel_category='.$_GET['id'].' ';}else{$filter=' where rel_category=0';}

$result = array();

try{
	$bd = new BaseDeDatos(new MySQL()); 
	$sql = new Sql();  
		
	$consulta = 'select * from ads_categories_theme'.$filter.' order by name';
	//echo $consulta;
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