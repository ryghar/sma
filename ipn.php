<?php
require_once('includes/constantes.php');
require_once('includes/idioma.php');
require_once('includes/usuario.php');
//ob_start();
//session_start();
// tell PHP to log errors to ipn_errors.log in this directory
ini_set('log_errors', true);
ini_set('error_log', 'log/ipn_errors.log');
foreach($_POST as $key=>$value){
	error_log($key.' === '.$value);
}
error_log(print_r($_POST));
// intantiate the IPN listener
include('includes/ipnlistener.php');
$listener = new IpnListener();

// tell the IPN listener to use the PayPal test sandbox
$listener->use_sandbox = PAYPAL_USESANDBOX;


// try to process the IPN POST
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
} catch (Exception $e) {
    error_log($e->getMessage());
    exit(0);
}


$EmailFrom=FROM;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' . $EmailFrom . "\r\n";
// TODO: Handle IPN Response here
if ($verified) {
    // TODO: Implement additional fraud checks and MySQL storage
	$UId=$_POST['item_number'];
	$Amount=$_POST['payment_gross'];
	$Recv=$_POST['business']; 
	$Send=$_POST['payer_email'];
	$Track=$_POST['ipn_track_id']; 
	$Usuario=new Usuario();
	$Usuario->setBalance($UId,$Amount,$Recv,$Send,$Track);

} else {
   mail('ryghar@gmail.com', 'Error:', $listener->getTextReport(), $headers);
}

?>