<?php
//Proceso Login
require_once('includes/Usuario.php');
if(isset($_POST['email'])){
	// Inicio de sesión
	session_start();
	if(empty($_POST['email'])){
	
	}
	if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])){
	
	}
	if(empty($_POST['password'])){
	
	}
	
	$Email=$_POST['email'];
	$Password=$_POST['password'];
	$Usuario=new Usuario();
	echo $Usuario->validaUsuario($Email, $Password);
}

