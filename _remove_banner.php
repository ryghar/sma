<?php
//Proceso remove banner
require_once('includes/Banner.php');
if(isset($_POST['id'])){
	$id=$_POST['id'];
	$idcampaign=$_POST['idcampaign'];
	$Banner=new Banner('temp');
	$Banner->clearCampaign($id, $idcampaign);
	echo '';
}

