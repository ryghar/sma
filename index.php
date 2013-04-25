<?php
require_once('includes/constantes.php');
require_once('includes/idioma.php');
require_once('includes/usuario.php');
$Usuario=new Usuario();
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
	<script type="application/javascript" src="js/popup.js"></script>
</head>
<body>
	<div id="header">
			<div id="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>		
			</div>
			<div id="cuenta">
				<form action="_login_usuario.php" method="post" class="FormLoginHome" id="FormLogin">
					<div class="uss"><?php echo FIELD_EMAIL;?>:<input type="text" id="email" name="email" size="10" class="input"/></div>
					<div class="pass"><?php echo FIELD_PASSWORD;?>:<input type="password" id="Password" name="password" size="10" class="input"/></div>
					<input type="hidden" name="formsubmitted" value="TRUE" />
					<div class="bot"><input class="SubmitButton" type="submit" value="Login" /></div>
				</form>	
			</div>	
			<ul>
				<li class="selected"><a href="index.html"><span><?php echo MENU1;?></span></a></li>
				<li><a href="#"><span><?php echo MENU2;?></span></a></li>
				<li><a href="#"><span><?php echo MENU3;?></span></a></li>
				<li><a href="#"><span><?php echo MENU4;?></span></a></li>
				<li><a href="#"><span><?php echo MENU5;?></span></a></li>			
			</ul>
	</div>
	<div id="body">
		<div class="header">
			<div id="content">

				<div id="divregistro">
					<form action="_registro_usuario.php" method="post" class="FormValida" id="FormRegistro">
						<fieldset>
							<legend><?php echo REGISTRO_FORM_TITLE;?></legend>

							<p class="line"><?php echo REGISTRO_FORM_SUBTITLE;?>  </p>
    
							<div class="elements">
								<p><label for="email"><?php echo FIELD_EMAIL;?> :</label>
								<input type="text" id="email" name="email" size="25" class="input" /></p>
								<p><label for="Password"><?php echo FIELD_PASSWORD;?>:</label>
								<input type="password" id="password" name="password" size="25" class="input" /></p>
								<p><label for="password2"><?php echo FIELD_PASSWORDRE;?>:</label>
								<input type="password" id="password2" name="password2" size="25" class="input"/></p>
								<p><label for="name"><?php echo FIELD_NOMBRE;?> :</label>
								<input type="text" id="name" name="name" size="25" class="input" /></p>
								<p><label for="pais"><?php echo FIELD_PAIS;?> :</label>
								<?php 
								try{
									echo Funciones::RenderCombo('pais','ads_countries','id_country',SELECT_TEXTO_PAIS,SELECT_TEXTO_PAIS);
								}catch(Exception $e){
									echo 'Error: '.$e->getMessage();
									?><script>mostrarPop('errormsgbox','Error en la conexión a la base de datos');</script><?php
								}
								?>
								</p>
								<p class="submit"><input type="hidden" name="formsubmitted" value="TRUE" />
								<input class="SubmitButton" type="submit" value="Register" id="regsubmit" /></p>
							</div>
							<div id="result"></div>
						</fieldset>
					</form>
		
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
<script>
$("#loginlink").click(function(){ $('#content').load('includes/login.php'); });

// Validación del formulario
	$("#FormRegistro").validate({
		rules: {
			email: {
				required: true,
				email: true
			},
			name: {
				required: true
			},
			password: {
				required: true,
				minlength: 8
			},
			password2: {
				required: true,
				minlength: 8,
				equalTo: "#password"
			}
		},
		messages: {
			email: "* Not valid",
			name: {
				required: "* Required"
			},
			password: {
				required: "* Required",
				minlength: "* Min lenght: 8"
			},
			password2: {
				required: "* Required",
				minlength: "* Min lenght: 8",
				equalTo: "* Not match"
			}
		}
	});
/* Capturo el submit */
$("#FormRegistro").submit(function(event) {

  /* evita el submit normal */
  event.preventDefault();
 
  /* Tomo los valores de los elementos del form */
  var $form = $( this ),
      vemail = $form.find( 'input[name="email"]' ).val(),
	  vname = $form.find( 'input[name="name"]' ).val(),
	  vpais = $form.find( 'input[name="pais"]' ).val(),
	  vpassword = $form.find( 'input[name="password"]' ).val(),
      url = $form.attr( 'action' );

  /* Envío por POST */
  var posting = $.post( url, { email: vemail, name: vname, password:vpassword, pais: 3 } );
  
  /* Retorno */
  posting.done(function( data ) {
	
	if(data==0){
		$("#regsubmit").attr("disabled", "disabled");
		mostrarPop('success','Se ha enviado un mail a su casilla con la información para activar su cuenta. Una vez verificada puede accerder al <a href="javascript:$(\'#content\').load(\'includes/login.php\');">login</a>');
	}else{
		mostrarPop('errormsgbox','Error en el proceso de registro ('+data+')');
	}
  });
});
// Validación del formulario de login
	$("#FormLogin").validate({
		rules: {
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 8
			}
		},
		messages: {
			email: "* Not valid",
			password: {
				required: "* Required",
				minlength: "* Min lenght: 8"
			}
		}
	});
/* Capturo el submit */
$("#FormLogin").submit(function(event) {

  /* evita el submit normal */
  event.preventDefault();
 
  /* Tomo los valores de los elementos del form */
  var $form = $( this ),
      vemail = $form.find( 'input[name="email"]' ).val(),
	  vpassword = $form.find( 'input[name="password"]' ).val(),
      url = $form.attr( 'action' );

  /* Envío por POST */
  var posting = $.post( url, { email: vemail, password:vpassword } );
  
  /* Retorno */
  posting.done(function( data ) {
	if(data==0){
		window.location.href = "app.php";
	}else{
		mostrarPop('errormsgbox','Error en el proceso de login ('+data+')');
	}
  });
});
</script>
</html>