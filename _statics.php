<?php
//Proceso de grupos
ob_start();
session_start();
require_once 'includes/BaseDeDatos.php'; 
require_once 'includes/MySQL.php'; 
require_once 'includes/Sql.php';
require_once 'includes/constantes.php';
require_once('includes/idioma.php');

if(isset($_REQUEST['desde'])){
	$FechaDesde=date('Ymd',strtotime($_REQUEST['desde']));
	$FechaHasta=date('Ymd',strtotime($_REQUEST['hasta']));
	$id_user=intval($_SESSION['id_user']);
	
	try{
		$bd = new BaseDeDatos(new MySQL()); 
		$sql = new Sql();  
		$consulta = "SELECT c.name as campaign, g.name as grupo, s.name_eng as status, r.date,r.ctr, r.clics,
		(CASE  
             WHEN r.model = 1 THEN r.conversions * r.bid
             WHEN r.model = 2 THEN r.clics * r.bid
             ELSE (r.impressions / 1000) * r.bid  
             END) AS spent 
						FROM ads_report_count_ss r 
						LEFT JOIN ssv_campaigns c ON c.id_campaign=r.id_campaign 
						LEFT JOIN ssv_groups g ON g.id_group=c.id_group 
						LEFT JOIN ssv_status s ON s.id_status=c.status 
						WHERE r.id_user=$id_user and r.date between '$FechaDesde' and '$FechaHasta'";
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

}

	


