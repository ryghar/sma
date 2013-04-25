<?php
// Idioma
if(isset($_GET['lang'])) $_SESSION['lang'] = $_GET['lang'];
if(isset($_SESSION['lang'])){
	include(DOCROOT.'/lang/lang_'.$_SESSION['lang'].'.php');
}else{
	// include(DOCROOT.'/lang/lang_'.detectarIdioma().'.php');
	include(DOCROOT.'/lang/lang_eng.php');
}