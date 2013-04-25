<?php
//Proceso activación de usuario
require_once('includes/Usuario.php');
if(isset($_GET['email'])){
	$Email=$_GET['email'];
	$Token=$_GET['token'];
	$Usuario=new Usuario();
	if($Usuario->valida($Email, $Token)){
		//echo 'Cuenta activa!!';
		header('Location: '.ROOT.'/startmeapp/info.php?msg=956293');
	}else{
		//echo 'Error en el proceso de validación de su cuenta';
		header('Location: '.ROOT.'/startmeapp/info.php?msg=646378');
	}

}

