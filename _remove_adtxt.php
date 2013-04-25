<?php
//Proceso remove adtext
require_once('includes/Campaign.php');
if(isset($_POST['id'])){
	$id=$_POST['id'];
	$idcampaign=$_POST['idcampaign'];
	$Campaign=new Campaign();
	$Campaign->clearadTxt($id, $idcampaign);
	echo '';
}

