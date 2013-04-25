<?php
//Proceso update campaign
require_once('includes/Usuario.php');
require_once('includes/Campaign.php');
if(isset($_POST['catprincipal'])){
	$CategoriaPrincipal=$_POST['catprincipal'];
	$CategoriaSecundaria=$_POST['catsecundaria'];
	if(intval($_POST['catsecundaria'])>0){
		$Categoria=intval($_POST['catsecundaria']);
	}else{
		$Categoria=intval($_POST['catprincipal']);
	}

	$Id=$_POST['idcampaign'];
	$Campaign=new Campaign();
	$Campaign->setCategory($Id,$Categoria);
	echo '';
}

