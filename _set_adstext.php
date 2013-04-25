<?php
//Proceso update adtext
require_once('includes/Usuario.php');
require_once('includes/Campaign.php');
if(isset($_POST['title'])){
	$Title=$_POST['title'];
	$Description=$_POST['description'];
	$Url=$_POST['url'];
	$Id=$_POST['idcampaign'];
	$Campaign=new Campaign();
	$idText=$Campaign->setAdsText($Id, $Title, $Description, $Url);

	echo $idText;
}

