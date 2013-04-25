<?php
//Proceso registro de usuario
require_once('includes/Usuario.php');
if(isset($_POST['name'])){
	$Email=$_POST['email'];
	$Nombre=$_POST['name'];
	$Password=$_POST['password'];
	$Pais=$_POST['pais'];
	$Usuario=new Usuario();
	echo $Usuario->registro($Email, $Nombre, $Password, $Pais);

}

