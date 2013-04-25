<?php
require_once 'BaseDeDatos.php'; 
require_once 'MySQL.php'; 
require_once 'Sql.php';
require_once('constantes.php');
require_once('idioma.php');

$result = array();
if(isset($_GET['id']) && $_GET['id']==3){$filter=' where id_status=3 ';}else{$filter='';}
try{
	$bd = new BaseDeDatos(new MySQL()); 
	$sql = new Sql();  
		
	$consulta = "select * from ssv_status".$filter." order by ".SELECT_TEXTO_STATUS;
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