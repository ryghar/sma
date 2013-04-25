<?php 
   include_once('funciones.php');
   include_once('constantes.php');

// Estiro las sesiones para que duren 8 horas
   ini_set('session.gc_maxlifetime', '28800');
   ini_set('session.cache_expire', '480');
      
// Guardo variables de sesión
   session_save_path(SESSION_PATH);
   session_start();
   
// Idioma
   if(isset($_GET['lang'])) $_SESSION['lang'] = $_GET['lang'];
   
   if(isset($_SESSION['lang'])){
   include(DOCROOT.'/lang/lang_'.$_SESSION['lang'].'.php');
   }else{
   // include(DOCROOT.'/lang/lang_'.detectarIdioma().'.php');
   include(DOCROOT.'/lang/lang_eng.php');
   }
?>
