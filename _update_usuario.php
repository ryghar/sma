<?php
//Proceso update profile
//echo 'hola';exit;
require_once('includes/Usuario.php');
if(isset($_POST['name'])){
	$Nombre=$_POST['name'];
	$Empresa=$_POST['empresa'];
	$Telefono=$_POST['telefono'];
	$Direccion=$_POST['direccion'];
	$CPostal=$_POST['cpostal'];
	$Id=$_POST['userid'];
	$Usuario=new Usuario();
	echo $Usuario->setProfile($Nombre, $Empresa, $Telefono, $Direccion, $CPostal, $Id);

}

