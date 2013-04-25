<?php
require_once('constantes.php');
require_once('idioma.php');
require_once('usuario.php');
$Usuario=new Usuario();
?>
<form action="_registro_usuario.php" method="post" class="FormValida" id="FormRegistro">
  <fieldset>
    <legend><?php echo REGISTRO_FORM_TITLE;?></legend>

    <p class="line"><?php echo REGISTRO_FORM_SUBTITLE;?>  </p>
    
    <div class="elements">
		<p><label for="email"><?php echo FIELD_EMAIL;?> :</label>
		<input type="text" id="email" name="email" size="25" /></p>
		<p><label for="Password"><?php echo FIELD_PASSWORD;?>:</label>
		<input type="password" id="password" name="password" size="25" /></p>
		<p><label for="password2"><?php echo FIELD_PASSWORDRE;?>:</label>
		<input type="password" id="password2" name="password2" size="25" /></p>
		<p><label for="name"><?php echo FIELD_NOMBRE;?> :</label>
		<input type="text" id="name" name="name" size="25" /></p>
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
<script>
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
</script>