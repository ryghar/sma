<?php
require_once('funciones.php');
require_once('constantes.php');
require_once('idioma.php');

?>
<form action="_login_usuario.php" method="post" class="FormValida" id="FormLogin">
  <fieldset>
    <legend><?php echo LOGIN_FORM_TITLE;?></legend>

    <p class="line"><?php echo LOGIN_FORM_SUBTITLE;?>  </p>
    
    <div class="elements">
      <p><label for="email"><?php echo FIELD_EMAIL;?> :</label>
      <input type="text" id="email" name="email" size="25" /></p>
	  <p><label for="password"><?php echo FIELD_PASSWORD;?> :</label>
      <input type="password" id="Password" name="password" size="25" /></p>
	  <p class="submit"><input type="hidden" name="formsubmitted" value="TRUE" />
      <input class="SubmitButton" type="submit" value="Login" /></p>
    </div>

  </fieldset>
</form>
<script>
// Validación del formulario
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