<?php
//Proceso update campaign
require_once('includes/Usuario.php');
require_once('includes/Campaign.php');
if(isset($_POST['brand'])){
	$Brand=$_POST['brand'];
	$Model=$_POST['model'];
	$Id=$_POST['idcampaign'];
	$Campaign=new Campaign();
	//$Campaign->setBrand($Id, $Brand);
	//$Campaign->setModel($Id, $Model);
	$Campaign->clearCarrier($Id);
	$Campaign->clearBrand($Id);
	$Campaign->clearModel($Id);

	foreach($_POST['carrier'] as $key=>$value){
		$Campaign->setCarrier($Id, $value['value']);
	}
	
	foreach($_POST['brand'] as $key=>$value){
		$Campaign->setBrand($Id, $value['value']);
	}
	
	foreach($_POST['model'] as $key=>$value){
		$Campaign->setModel($Id, $value['value']);
	}
	echo '';
}

