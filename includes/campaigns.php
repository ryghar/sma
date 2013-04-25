<?php
ob_start();
session_start();
require_once('constantes.php');
require_once('idioma.php');
require_once('usuario.php');
$Usuario=new Usuario;
$UsuarioDatos=$Usuario->getUsuario($_SESSION['id_user']);

//echo Funciones::RenderCombo('pais','ads_countries','id_country',SELECT_TEXTO_PAIS,SELECT_TEXTO_PAIS, '', "","","", $class="easyui-combobox");
?>
<script type="text/javascript">

		var url;
		function newCampaign(){
			$('#dlg').dialog('open').dialog('setTitle','<?php echo CAMPAIGNS_NEW_TITLE;?>');
			$('#fm').form('clear');
			$('#action').val('new');
			url = '_campaigns.php?iduser=<?php echo $_SESSION['id_user'];?>';
		}
		function editCampaign(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','<?php echo CAMPAIGNS_EDIT_TITLE;?>');
				$('#fm').form('load',row);
				$('#action').val('edit');
				url = '_campaigns.php?id='+row.id_campaign;
				//console.dir(row);
			}
		}
		function saveCampaign(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					//$('#dlg').dialog('close');		// close the dialog
					//$('#dg').datagrid('reload');	// reload the user data
					return $(this).form('validate');
				},
				success:function(){  
					$('#dlg').dialog('close');
					$('#dg').datagrid('reload');
				}  
			});
			$('#dg').datagrid('reload');
		}
		function removeCampaign(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','<?php echo CAMPAIGNS_REMOVE_CONFIRM;?>',function(r){
					if (r){
						$.post('_campaigns.php',{id:row.id_group,action:'borra'},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
						$('#dg').datagrid('reload');
						$('#dg').datagrid('resize');
					}
				});
			}
		}

	</script>
<fieldset><legend><?php echo CAMPAIGNS_FORM_TITLE;?></legend></fieldset>

	<table id="dg"></table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newCampaign()"><?php echo CAMPAIGNS_NEW;?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editCampaign()"><?php echo CAMPAIGNS_EDIT;?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeCampaign()"><?php echo CAMPAIGNS_REMOVE;?></a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:500px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle"><?php echo CAMPAIGNS_FORM_SUBTITLE;?></div>
		<form id="fm" method="post" novalidate>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_NAME;?>:</label>
				<input name="name" class="easyui-validatebox" required="true">
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_DESCRIPTION;?>:</label>
				<input name="description">
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_STATUS;?>:</label>
				<input class="easyui-combobox" name="status" 
								data-options="  
								url:'includes/json_status.php',  
								valueField:'id_status',  
								textField:'<?php echo SELECT_TEXTO_STATUS;?>',  
								panelHeight:'auto'
				">  
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_COUNTRY;?>:</label>
				<input class="easyui-combobox" name="id_country"  
					data-options="  
								url:'includes/json_country.php',  
								valueField:'id_country',  
								textField:'<?php echo SELECT_TEXTO_PAIS;?>'">  
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_GROUP;?>:</label>
				<input class="easyui-combobox" name="id_group"  
					data-options="  
								url:'_grupos.php?action=json',  
								valueField:'id_group',  
								textField:'name',  
								panelHeight:'20px'
				">  
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_URL;?>:</label>
				<input name="url" class="easyui-validatebox" data-options="required:true,validType:'url'">
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_BID;?>:</label>
				<input name="bid">
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_CAP;?>:</label>
				<input name="cap">
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_MODEL_RATE;?>:</label>
				<input class="easyui-combobox" name="model_rate" required="true" 
					data-options="
							valueField: 'label',
							textField: 'value',
							data: [{label: '1',	value: 'cpa'},{label: '2',value: 'cpc'},{label: '3',value: 'cpm'}]">  
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_DATE_START;?>:</label>
				<input id="dstart" name="date_start" type="text" class="easyui-datebox" required="required"></input> 
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_DATE_END;?>:</label>
				<input id="dend" name="date_end" type="text" class="easyui-datebox" required="required"></input> 
			</div>
	
			<input type="hidden" name="action" id="action" value="">
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveCampaign()"><?php echo BUTTON_SAVE;?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')"><?php echo BUTTON_CANCEL;?></a>
	</div>
	<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
	<script>
	$('#dg').datagrid({  
		url:'_campaigns.php',  
		columns:[[  
			{field:'id_campaign', Title:' ', width: 10, hidden:true},
			{field:'name',title:'<?php echo CAMPAIGNS_COL_NAME;?>',width:100},  
			{field:'description',title:'<?php echo CAMPAIGNS_COL_DESCRIPTION;?>',width:100},  
			{field:'grupo',title:'<?php echo CAMPAIGNS_COL_GROUP;?>',width:100,align:'right'},
			{field:'statustxt',title:'<?php echo CAMPAIGNS_COL_STATUS;?>',width:70,align:'right'},
			{field:'bid',title:'<?php echo CAMPAIGNS_COL_BID;?>',width:50,align:'right'},
			{field:'url',title:'<?php echo CAMPAIGNS_COL_URL;?>',width:160,align:'right'},
			{field:'userId',title:'',formatter:function (value, rowData, rowIndex) {
//var div ='<div id="stats" >'+rowData.name+'< /div>';
var div='<img src="css/icons/search.png" class="hand" onclick="javascript:$(\'#datos\').load(\'includes/campaign_detail.php?id='+rowData.id_campaign+'\');return false;">';
return div;
}}
		]],
		toolbar: '#toolbar',
		queryParams: {
			action: 'lista',
			subject: 'datagrid'
		}
	}); 

	</script>