<?php
require_once 'BaseDeDatos.php'; 
require_once 'MySQL.php'; 
require_once 'Sql.php';
require_once('constantes.php');
require_once('idioma.php');
$brands_id='';
foreach($_GET as $key=>$value){
	$brands_id.=$value.',';
}
$brands_id=substr($brands_id,0,-1);

if(isset($_GET['0'])){$filter=' where id_brand in ('.$brands_id.') ';}else{$filter=' where 2=1 ';}

$result = array();

try{
	$bd = new BaseDeDatos(new MySQL()); 
	$sql = new Sql();  
		
	$consulta = 'select * from ads_cell_models'.$filter.' order by name';
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