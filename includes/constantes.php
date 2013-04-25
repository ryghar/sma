<?php
require_once('funciones.php');

// Defino valores constantes dependiendo de la versión local o remota
switch(Funciones::domainName()){
		// DESARROLLO
		case 'com.ar':
						// Sesiones, rutas y cookies
						if(!strpos(dirname(__FILE__),'\\')){
							define("SESSION_PATH", str_replace("/includes", "", dirname(__FILE__)."/phpsessions"));
							define("DOCROOT", str_replace("/includes", "", dirname(__FILE__)));
						}else{						
							define("SESSION_PATH", str_replace("\\includes", "", dirname(__FILE__)."/phpsessions"));
							define("DOCROOT", str_replace("\\includes", "", dirname(__FILE__)));
						}
						define("ROOT", "http://www.dtalle.com.ar");
						define("COOKIE", true);
						// Conexión a DB remota
						define("DBHost", "localhost:3307");
						define("DBUser", "www");
						define("DBPass", "trebol");
						define("DBMain", "sma_ssv");
						// Defino entorno de trabajo local o remoto
						define("ENV", true);
						break;
		// PRODUCCION
		case 'startmeapp.net':
						// Sesiones, rutas y cookies
						define("SESSION_PATH", str_replace("/includes", "", dirname(__FILE__)."/phpsessions"));
						define("DOCROOT", str_replace("/includes", "", dirname(__FILE__)));
						define("ROOT", "http://adserver.startmeapp.net"); // adserver.startmeapp.net
						define("COOKIE", true);
						// Conexión a DB remota
						define("DBHost", "");
						define("DBUser", "");
						define("DBPass", "");
						define("DBMain", "");
						// Defino entorno de trabajo local o remoto
						define("ENV", true);
						break;
		// LOCAL
		default:
						// Sesiones, rutas y cookies
						define("SESSION_PATH", str_replace("\\includes", "", dirname(__FILE__)."/phpsessions"));
						define("DOCROOT", str_replace("\\includes", "", dirname(__FILE__)));
						define("ROOT", "http://localhost");
						define("COOKIE", false);
						// Conexión a DB local
						define("DBHost", "localhost");
						define("DBUser", "www");
						define("DBPass", "trebol");
						define("DBMain", "sma_ssv");
						// Defino entorno de trabajo local o remoto
						define("ENV", false);
						break;
}

// General
define("SITE", "StartMeApp :: AdServer Platform");
// Archivos
define("FILE", basename($_SERVER['PHP_SELF']));
define("URL", base64_encode($_SERVER['REQUEST_URI']));
define("UPLOADDIR",DOCROOT.'/files/');
// Email
define("SMTP", "smtp.gmail.com");
define("USERNAME", "email@domain.com");
define("PASSWORD", "password");
define("FROM", "noreply@dtalle.com.ar");
define("PORT", 465);
define("PAYPAL_RETURN", "http://startmeapp.dtalle.com.ar/app.php");
define("PAYPAL_IPN", "http://startmeapp.dtalle.com.ar/ipn.php");
define("PAYPAL_USESANDBOX", true);
define("PAYPAL_BUSSINESS",'rygharvendedor@gmail.com');


