<?php
ob_start();
session_start();
require_once('constantes.php');
require_once('idioma.php');
require_once('funciones.php');
require_once('usuario.php');
require_once('Campaign.php');
require_once('Banner.php');
$Usuario=new Usuario;
$Campaign=new Campaign;
$UsuarioDatos=$Usuario->getUsuario($_SESSION['id_user']);
if(isset($_GET['id']) && $CampaignDatos=$Campaign->getCampaign($_GET['id'])){
$CampaignCarriers=$Campaign->getCarriers($_GET['id']);
$CampaignBrands=$Campaign->getBrands($_GET['id']);
$CampaignModels=$Campaign->getModels($_GET['id']);
$CampaignCategory=$Campaign->getCategory($_GET['id']);
function getModelRate($id)
	{
		switch($id){
			case 0: $ModelRate='CPA';
					break;
			case 1: $ModelRate='CPC';
					break;
			case 2: $ModelRate='CPM';
					break;
		}
		return $ModelRate;
	}

?>
<div id="aa" class="easyui-accordion" style="width:621px;height:400px;">
	<div title="<?php echo CAMPAIGN_DETAIL_FORM_TITLE.$CampaignDatos['name'];?>" data-options="iconCls:'icon-ok'" style="overflow:auto;">
		<legend><?php echo CAMPAIGN_DETAIL_FORM_TITLE.$CampaignDatos['name'];?></legend>
		<div>
			<div>
				<div class="detail"><b><?php echo CAMPAIGNS_COL_NAME;?> : </b><?php echo $CampaignDatos['name'];?></div>
				<div class="detail"><b><?php echo CAMPAIGNS_COL_DESCRIPTION;?> : </b><?php echo $CampaignDatos['description'];?></div>
				<div class="detail"><b><?php echo CAMPAIGNS_COL_GROUP;?> : </b><?php echo $CampaignDatos['grupo'];?></div>
			</div>
			<div>
				<div class="detail"><b><?php echo CAMPAIGNS_COL_STATUS;?> : </b><?php echo $CampaignDatos['estado'];?></div>
				<div class="detail"><b><?php echo CAMPAIGNS_COL_COUNTRY;?> : </b><?php echo $CampaignDatos['pais'];?></div>
				<div class="detail"><b><?php echo CAMPAIGNS_COL_URL;?> : </b><?php echo $CampaignDatos['url'];?></div>
			</div>
			<div>
				<div class="detail"><b><?php echo CAMPAIGNS_COL_BID;?> : </b><?php echo $CampaignDatos['bid'];?></div>
				<div class="detail"><b><?php echo CAMPAIGNS_COL_CAP;?> : </b><?php echo $CampaignDatos['cap'];?></div>
				<div class="detail"><b><?php echo CAMPAIGNS_COL_MODEL_RATE;?> : </b><?php echo getModelRate($CampaignDatos['model_rate']);?></div>
			</div>
			<div>
				<div class="detail"><b><?php echo CAMPAIGNS_COL_DATE_START;?> : </b><?php echo $CampaignDatos['date_start'];?></div>
				<div class="detail"><b><?php echo CAMPAIGNS_COL_DATE_END;?> : </b><?php echo $CampaignDatos['date_end'];?></div>
				<div class="detail">&nbsp</div>
			</div>
		</div>
	</div>
	<div title="<?php echo CAMPAIGN_DETAIL_FORM_SEGMENT;?>" data-options="iconCls:'icon-edit'" style="overflow:auto;">
		<form action="_set_target.php" method="post" class="FormValida" id="FormRegistro">
			<div id="segmento">
				<legend><?php echo CAMPAIGN_DETAIL_FORM_SEGMENT;?></legend>
				<div>

					<input type="hidden" name="idcampaign" value="<?php echo $CampaignDatos['id_campaign'];?>">
					<div class="detail">
						<?php echo CAMPAIGN_DETAIL_BRAND;?> : <input id="brand" name="brand" class="easyui-combobox" data-options="  
																			valueField: 'id_brand',  
																			textField: 'name',  
																			width:140,
																			editable: false,
																			multiple:true,
																			url: 'includes/json_brand.php',
																			onChange: function(rec){  
																				serieBrand=sBrand();
																				var url = 'includes/json_model.php?'+serieBrand;
																				//$('#model').combobox('clear');
																				$('#model').combobox('reload', url);  
																			}" 
																			/>
					</div>
					<div class="detail">
						<?php echo CAMPAIGN_DETAIL_MODEL;?> : <input id="model" name="model" class="easyui-combobox" data-options="
																			valueField:'id_model',textField:'name',width:140,editable: false,multiple:true,
																			url : 'includes/json_model.php?id=<?php echo $CampaignDatos['id_brand'];?>'" 
																			/>
					</div>
				</div>
				<div>
					<div class="detail"><?php echo CAMPAIGN_DETAIL_CARRIERS;?> : <input id="carrier" name="carrier[]" class="easyui-combobox" data-options="  
																			valueField: 'id_carrier',  
																			textField: 'carrier',
																			width:140,
																			editable: false,
																			multiple:true,
																			url: 'includes/json_carrier.php?id=<?php echo $CampaignDatos['id_country'];?>'"/>
					</div>
				</div>
				<div id="fm-submit" class="fm-req">
					<input name="Submit" value="<?php echo BUTTON_UPDATE;?>" type="submit" class="botonUpdate"/>
				</div>	
			</div>
		</form>
	</div>
	<div title="<?php echo CAMPAIGN_DETAIL_FORM_CATEGORY;?>" data-options="iconCls:'icon-edit'" style="overflow:auto;">
		<form action="_set_category.php" method="post" class="FormValida" id="FormCategory">
			<div id="category">
				<legend><?php echo CAMPAIGN_DETAIL_FORM_CATEGORY;?></legend>
				<div>

					<input type="hidden" name="idcampaign" value="<?php echo $CampaignDatos['id_campaign'];?>">
					<div class="detail">
						<?php echo CAMPAIGN_DETAIL_CATEGORY_PRINCIPAL;?> : <input id="catprincipal" name="catprincipal" class="easyui-combobox" data-options="  
																			valueField: 'id_category',  
																			textField: 'name',  
																			width:140,
																			editable: false,
																			multiple:false,
																			url: 'includes/json_category.php',
																			onChange: function(rec){  
																				var url = 'includes/json_category.php?id='+rec;
																				$('#catsecundaria').combobox('clear');
																				$('#catsecundaria').combobox('reload', url);  
																			}" 
																			/>
					</div>
					<div class="detail">
						<?php echo CAMPAIGN_DETAIL_CATEGORY_SECONDARY;?> : <input id="catsecundaria" name="catsecundaria" class="easyui-combobox" 
																			data-options="
																			valueField:'id_category',
																			textField:'name',
																			width:140,
																			editable: false,
																			multiple:false" 
																			/>
					</div>
				</div>
				<div id="fm-submit" class="fm-req">
					<input name="Submit" value="<?php echo BUTTON_UPDATE;?>" type="submit" class="botonUpdate"/>
				</div>	
			</div>
		</form>
	</div>
	<div title="<?php echo CAMPAIGN_DETAIL_FORM_CREATIVIDAD;?>" data-options="iconCls:'icon-edit'" style="overflow:auto;">
		<form action="_uploader.php" method="post" class="FormValida" id="FormCreatividad">
			<div id="creatividadfile">
				<legend><?php echo CAMPAIGN_DETAIL_FORM_CREATIVIDAD;?></legend>
				<div>
					<input type="hidden" name="idcampaign" value="<?php echo $CampaignDatos['id_campaign'];?>">
					<div class="detail">
						<?php echo CAMPAIGN_DETAIL_FILE_TITLE;?> : <input id="filetitle" name="filetitle"/>
					</div>
					<div class="detail"><?php echo CAMPAIGN_DETAIL_FILE;?> : 
						<input type="file" name="mFile" id="mFile"/>
						<button type="submit" class="botonUpdate" id="uploadButton">Upload</button>
					</div>
					<div id="output"></div>
				</div>
				<div id="imagenes">
					<ul id="imgcont">
						<?php
							$Banner=new Banner('Imagenes');
							echo $Banner->getBannersCampaign($_GET['id']);
						?>
					</ul>
				</div>
			</div>
		</form>
	</div>
	<div title="<?php echo CAMPAIGN_DETAIL_FORM_ADSTEXT;?>" data-options="iconCls:'icon-edit'" style="overflow:auto;">
		<form action="_set_adstext.php" method="post" class="FormValida" id="FormAdsText">
			<div id="adstext">
				<legend><?php echo CAMPAIGN_DETAIL_FORM_ADSTEXT;?></legend>
				<div>
					<input type="hidden" name="idcampaign" id="idcampaign" value="<?php echo $CampaignDatos['id_campaign'];?>">
					<div class="detail"><?php echo CAMPAIGN_DETAIL_ADSTEXT_TITLE;?> : <input id="adsTitle" name="adsTitle"/></div>
					<div class="detail"><?php echo CAMPAIGN_DETAIL_ADSTEXT_DESC;?> : <input id="adsDescription" name="adsDescription"/></div>
					<div class="detail"><?php echo CAMPAIGN_DETAIL_ADSTEXT_URL;?> : <input id="adsUrl" name="adsUrl"/></div>
				</div>
				<div id="fm-submit" class="fm-req">
					<input name="Submit" value="<?php echo BUTTON_UPDATE;?>" type="submit" class="botonUpdate"/>
				</div>	
				<div id="textosads">
					<table id="TableAd">
						<thead>
							<th>Title</th>
							<th>Description</th>
							<th>Url</th>
						</thead>
						<tbody>
						<?php
							echo $Campaign->getAdsTextCampaign($_GET['id']);
						?>
						</tbody>
					</table>
					
				</div>
			</div>
		</form>
	</div>
</div>
<div class="fm-req">
			<input name="Submit" value="<?php echo BUTTON_CLOSE;?>" type="text" onclick="$('#datos').empty();return false;" class="hand"/>
	</div>	
<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
<script>
//$('#brand').combobox('setValue', '<?php echo $CampaignDatos['id_brand'];?>');
$('#model').combobox('setValue', '<?php echo $CampaignDatos['id_model'];?>');
<?php
$Valores='';
foreach($CampaignCarriers as $key=>$value){
	$Valores.="'".$value['id_carrier']."',";
}
$Valores=substr($Valores,0,-1);
echo "$('#carrier').combobox('setValues', [".$Valores."]);";

$Valores='';
foreach($CampaignBrands as $key=>$value){
	$Valores.="'".$value['id_brand']."',";
}
$Valores=substr($Valores,0,-1);
echo "$('#brand').combobox('setValues', [".$Valores."]);";

$Valores='';
foreach($CampaignModels as $key=>$value){
	$Valores.="'".$value['id_model']."',";
}
$Valores=substr($Valores,0,-1);
echo "$('#model').combobox('setValues', [".$Valores."]);";

if($CampaignCategory['rel_category']>0){
	echo "$('#catprincipal').combobox('setValue', '".$CampaignCategory['rel_category']."');";
	echo "$('#catprincipal').combobox('setValue', '".$CampaignCategory['rel_category']."');";
	echo "$('#catsecundaria').combobox('setValue', '".$CampaignCategory['id_cat_theme']."');";

}else{

	echo "$('#catprincipal').combobox('setValue', '".$CampaignCategory['id_cat_theme']."');";

}

?>

function sBrand(){
	var brand=$('input[name=brand]');
	brandsCollection=[];
	brandsCollection.push({name: 0,value: -1});
	$('input[name=brand]').each(function(rowId,data) {
				if(data.value!=''){
					brandsCollection.push({name: rowId,value: data.value});
				}
	});
	serieBrand=$.param(brandsCollection);
	console.log(serieBrand);
	return serieBrand;
}
/* Proceso set target */
$("#FormRegistro").submit(function(event) {
  /* evita el submit normal */
  event.preventDefault();
 
  /* Tomo los valores de los elementos del form */
  var $form = $( this ),
	  //vbrand = $form.find( 'input[name="brand[]"]' ).val(),
	  //vmodel = $form.find( 'input[name="model[]"]' ).val(),
	  vidcampaign = $form.find( 'input[name="idcampaign"]' ).val(),
	  vcarrier = $form.find( 'input[name="carrier[]"]' ).serializeArray(),
	  vbrand = $form.find( 'input[name="brand"]' ).serializeArray(),
	  vmodel = $form.find( 'input[name="model"]' ).serializeArray(),
      url = $form.attr( 'action' );

  /* Envío por POST */
  var posting = $.post( url, { brand: vbrand, model: vmodel, idcampaign: vidcampaign, carrier: vcarrier} );
  /* Retorno */
  posting.done(function( data ) {
		//$("#regsubmit").attr("disabled", "disabled");
		mostrarPop('success','Campaign updated');
  });
});
/* Proceso set category */
$("#FormCategory").submit(function(event) {
  /* evita el submit normal */
  event.preventDefault();
 
  /* Tomo los valores de los elementos del form */
  var $form = $( this ),
	  vidcampaign = $form.find( 'input[name="idcampaign"]' ).val(),
	  vprincipal = $form.find( 'input[name="catprincipal"]' ).val(),
	  vsecundaria = $form.find( 'input[name="catsecundaria"]' ).val(),
      url = $form.attr( 'action' );

  /* Envío por POST */
  var posting = $.post( url, { catprincipal: vprincipal, catsecundaria: vsecundaria, idcampaign: vidcampaign} );
  /* Retorno */
  posting.done(function( data ) {
		//$("#regsubmit").attr("disabled", "disabled");
		mostrarPop('success','Campaign updated');
  });
});
/* Proceso ads text */
$("#FormAdsText").submit(function(event) {
  /* evita el submit normal */
  event.preventDefault();
 
  /* Tomo los valores de los elementos del form */
  var $form = $( this ),
	  vtitle = $form.find( 'input[name="adsTitle"]' ).val(),
	  vdescription = $form.find( 'input[name="adsDescription"]' ).val(),
	  vurl = $form.find( 'input[name="adsUrl"]' ).val(),
	  vidcampaign = $form.find( 'input[name="idcampaign"]' ).val(),
      url = $form.attr( 'action' );

  /* Envío por POST */
  var posting = $.post( url, { title: vtitle, description: vdescription, url: vurl, idcampaign: vidcampaign} );
  /* Retorno */
  posting.done(function( data ) {
		var idcampaign=$("#idcampaign").val();
		var title=$("#adsTitle").val();
		var description=$("#adsDescription").val();
		var url=$("#adsUrl").val();
		//alert(data);
		//$("#textosads").append('<span id="txt'+data+'" onclick="remTxt(this.id);"><p>'+title+' | '+description+' | '+url+'</p></span>');
		$('#TableAd tr:last').after('<tr id="txt'+data+'"><td>'+title+'</td><td>'+description+'</td><td>'+url+'</td><td  onclick="remTxt(txt'+data+');"><img src="css/icons/cancel.png"</td></tr>');
  });
});

$(document).ready(function()
{
    $('#FormCreatividad').on('submit', function(e)
    {
        e.preventDefault();
        $('#uploadButton').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output").html('<div style="padding:10px"><img src="images/ajax-loader.gif" alt="Please Wait"/> <span>Uploading...</span></div>');
        $(this).ajaxSubmit({
        target: '#output',
        success:  afterSuccess //call function after success
        });
		//}
    });
	$('#aa').accordion({  
    border:true  
});
});
 
function afterSuccess()
{
    $('#FileUploader').resetForm();  // reset form
    $('#uploadButton').removeAttr('disabled'); //enable submit button
	if($("#output").html()){
		var respuesta=$("#output").html().split('@');
		var archivo=respuesta[0];
		var id=respuesta[1];
		$("#imgcont").append('<li title="Click to remove: '+archivo+'"><img src="files/'+archivo+'" onclick="remImg(this.id);" id="img'+id+'"></li>');
	}
}

function remImg(vid){
	var idbanner=vid.substr(3);
	var posting = $.post( '_remove_banner.php', { id: idbanner, idcampaign: <?php echo $_GET['id'];?>} );
	/* Retorno */
	posting.done(function( data ) {
		//$("#regsubmit").attr("disabled", "disabled");
		if(confirm('<?php echo CAMPAIGN_DETAIL_FILE_REMOVE;?>')){
			$("#"+vid).remove();
		}
	});
}

function remTxt(vid){
	var idAdText=vid.id;
	var idAdText=idAdText.substr(3);
	if(confirm('borro el txt?')){
		var posting = $.post( '_remove_adtxt.php', { id: idAdText, idcampaign: <?php echo $_GET['id'];?>} );
		posting.done(function( data ) {
			vid.remove();
		});
	}
	
}


</script>
<?php
}
?>