<?php
ob_start();
session_start();
require_once('constantes.php');
require_once('idioma.php');
require_once('usuario.php');
$Usuario=new Usuario;
$UsuarioDatos=$Usuario->getUsuario($_SESSION['id_user']);
?>
<form action="_update_usuario.php" method="post" id="FormRegistro">
	<fieldset>
		<legend><?php echo PROFILE_FORM_TITLE;?></legend>


		<div>
			<div><label for="name"><?php echo FIELD_NOMBRE;?> :</label>
			<input type="text" id="name" name="name" size="25" value="<?php echo $UsuarioDatos[0]['name'];?>" /></div>
			<div><label for="empresa"><?php echo FIELD_EMPRESA;?> :</label>
			<input type="text" id="empresa" name="empresa" size="25" value="<?php echo $UsuarioDatos[0]['commercial'];?>" /></div>
			<div><label for="telefono"><?php echo FIELD_TELEFONO;?> :</label>
			<input type="text" id="telefono" name="telefono" size="25" value="<?php echo $UsuarioDatos[0]['phone'];?>" /></div>
			<div><label for="direccion"><?php echo FIELD_DIRECCION;?> :</label>
			<input type="text" id="direccion" name="direccion" size="25" value="<?php echo $UsuarioDatos[0]['address'];?>" /></div>
			<div><label for="cpostal"><?php echo FIELD_CPOSTAL;?> :</label>
			<input type="text" id="cpostal" name="cpostal" size="25" value="<?php echo $UsuarioDatos[0]['zip'];?>" /></div>
			<div><label for="balance"><?php echo FIELD_BALANCE;?> :</label>
			<input type="text" id="balance" name="balance" size="25" readonly="true"  value="<?php echo $UsuarioDatos[0]['balance'];?>"/></div>
			<input type="hidden" name="formsubmitted" value="TRUE" />
			<input type="hidden" name="userid" value="<?php echo $UsuarioDatos[0]['id_user'];?>" />
		</div>
	<div id="result"></div>
	</fieldset>
	<div id="fm-submit" class="fm-req">
			<input name="Submit" value="<?php echo BUTTON_UPDATE;?>" type="submit"/>
	</div>	
</form>
<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
	<fieldset>
		
		<legend><?php echo PROFILE_PAYPAL_TITLE;?></legend>
		<div>
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="<?php echo PAYPAL_BUSSINESS;?>">
			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="item_name" value="StartMeApp">
			<input type="hidden" name="item_number" value="<?php echo $_SESSION['id_user'];?>"> 
			<div>
				<label for="amount"><?php echo FIELD_AMOUNT;?> :</label>
				<input type="text" name="amount" value="9.99">
				<input type="image" src="http://www.paypal.com/en_US/i/btn/btn_buynow_SM.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
			</div>
			<input type="hidden" name="return" value="<?php echo PAYPAL_RETURN;?>">
			<input type="hidden" name="notify_url" value="<?php echo PAYPAL_IPN;?>">
			
		</div>
</form>
<script>
/* Capturo el submit */
$("#FormRegistro").submit(function(event) {

  /* evita el submit normal */
  event.preventDefault();
 
  /* Tomo los valores de los elementos del form */
  var $form = $( this ),
	  vname = $form.find( 'input[name="name"]' ).val(),
	  vempresa = $form.find( 'input[name="empresa"]' ).val(),
	  vtelefono = $form.find( 'input[name="telefono"]' ).val(),
	  vdireccion = $form.find( 'input[name="direccion"]' ).val(),
	  vcpostal = $form.find( 'input[name="cpostal"]' ).val(),
	  vuserid = $form.find( 'input[name="userid"]' ).val(),
      url = $form.attr( 'action' );

  /* Envío por POST */
  var posting = $.post( url, { name: vname, empresa: vempresa, telefono:vtelefono, direccion:vdireccion, cpostal:vcpostal, userid:vuserid  } );
  
  /* Retorno */
  posting.done(function( data ) {
	if(data==''){
		$("#regsubmit").attr("disabled", "disabled");
		mostrarPop('success','Profile updated');
	}else{
		mostrarPop('errormsgbox','Error ('+data+')');
	}
  });
});
</script>