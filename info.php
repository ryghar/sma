<?php
require_once('includes/constantes.php');
require_once('includes/idioma.php');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo SITE;?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/header.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/footer.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/popup.css" media="all" />
	<script type="text/javascript" src="js/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<script language="javascript" type="text/javascript" src="js/popup.js"></script>
</head>
<body>
	<div id="header">
			<div id="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>		
			</div>
			<div id="cuenta">
				<a href="javascript:$('#content').load('includes/login.php');"><?php echo LOGIN_LINK;?></a> -
				<a href="javascript:$('#content').load('includes/registro.php');"><?php echo REGISTRO_LINK;?></a>	
			</div>	
	</div>
	<div id="body">
		<div class="header">
			<div id="content">
		
				<div>
					<h3><?php 
							if($_GET['msg']=='956293'){
								echo CUENTA_ACTIVA;
							}
							if($_GET['msg']=='646378'){
								echo CUENTA_ACTIVA_ERROR;
							}
						?></h3>	
					<p><?php echo SUBSLOGAN;?></p>		
				</div>
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
			<p>&copy Copyright 2012. All rights reserved</p>
		</div>
	</div>
	<div id="pop" class="success"></div>
</div>
</body>
</html>