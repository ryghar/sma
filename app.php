<?php
ob_start();
session_start();
if(!isset($_SESSION['Usuario'])){
         header("Location: index.php");
}
require_once('includes/constantes.php');
require_once('includes/idioma.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo SITE;?></title>
	<link rel="stylesheet" type="text/css" href="css/header.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/footer.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/styleapp.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/popup.css" media="all" />
	
	<link rel="stylesheet" type="text/css" href="css/easyui.css">
	<link rel="stylesheet" type="text/css" href="css/icon.css">
	
	<script type="text/javascript" src="js/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<script language="javascript" type="text/javascript" src="js/popup.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script>
	google.load('visualization', '1.0', {'packages':['corechart']});
	
	function BorraDivs(){
		//$(".panel window, .panel combo-p").each(function() { alert('hola'); });
		$('#dlgroups-buttons').remove();
		$('#dlcampaigns-buttons').remove();
		$('#dlgroups').remove();
		$('#dlcampaigns').remove();
		$('#fmgroups').remove();
		$('#fmcampaign').remove();
		//$('#dg').remove();
	}
	</script>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div id="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>		
			</div>
			<div id="cuenta">
				<div class="login"><a href="#"><?php echo LOGOUT_LINK;?></a></div> -
				<div class="logout"><a href="#"><?php echo REGISTRO_LINK;?></a></div>	
			</div>
		</div>
		<div id="contenido">
			<div id="status"><?php echo $_SESSION['Usuario'];?>
			</div>
			<div id="menu">
				<div id="leftcolumn">
					<ul class="mainnav">
						<li class="border-top"><a href="#" onclick="javascript:$('#datos').load('includes/profile.php');return false;"><?php echo NAV_ITEM1;?></a></li>
						<li><a href="#" onclick="javascript:BorraDivs();$('#datos').load('includes/groups.php');return false;"><?php echo NAV_ITEM3;?></a></li>
						<li><a href="#" onclick="javascript:BorraDivs();$('#datos').load('includes/statics.php');return false;"><?php echo NAV_ITEM4;?></a></li>
					</ul>
				</div>
			</div>
			<div id="datos">
			</div>
		</div>
		
	</div>
	<div id="footer">
			<div>
				<div>
					<h3>London</h3>
					<ul>
						<li>+44 20 8144 8068</li>				
						<li>adress</li>
					</ul>			
				</div>		
				<div>
					<h3>Miami</h3>
					<ul>
						<li>+1 786 406 6164</li>				
						<li>adress</li>
					</ul>			
				</div>	
				<div>
					<h3>New York</h3>
					<ul>
						<li>+1 718 577 5476</li>				
						<li>adress</li>
					</ul>			
				</div>	
				<div>
					<h3>Buenos Aires</h3>
					<ul>
						<li>+54 11 4782 4126</li>				
						<li>adress</li>
					</ul>			
				</div>	
				<div>
					<h3>follow us:</h3>
					<a class="facebook" href="http://www.facebook.com/SMANetworks" target="_blank">facebook</a>		
					<a class="twitter" href="https://twitter.com/StartMeApp" target="_blank">twitter</a>
				</div>	
			</div>
			<div>
				<p>&copy Copyright 2013. All rights reserved</p>
			</div>
		
		</div>
	<div id="pop" class="success"></div>
</body>
</html>