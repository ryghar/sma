<?php
ob_start();
session_start();
require_once('constantes.php');
require_once('idioma.php');
require_once('usuario.php');
$Usuario=new Usuario;
$UsuarioDatos=$Usuario->getUsuario($_SESSION['id_user']);
?>
<script type="text/javascript">

		var url;
		//Groups functions
		function newGroup(){
			$('#dlgroups').dialog('open').dialog('setTitle','<?php echo GROUPS_NEW_TITLE;?>');
			$('#fmgroups').form('clear');
			$('#actionGroups').val('new');
			url = '_grupos.php?iduser=<?php echo $_SESSION['id_user'];?>';
		}
		function editGroup(id){
			if (id){
				$('#dlgroups').dialog('open').dialog('setTitle','<?php echo GROUPS_EDIT_TITLE;?>');
				$('#fmgroups').form('load','_grupos.php?actionGroups=load&idgroup='+id);
				$('#actionGroups').val('edit');
				url = '_grupos.php?id='+id;
			}
		}
		function saveGroup(){
			$('#fmgroups').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success:function(){  
					$('#dlgroups').dialog('close');
					loadTable('json');
					$('#id_group').combobox('reload');
				}  
			});
		}
		function removeGroup(id){
			if (id){
				$.messager.confirm('Confirm','<?php echo GROUPS_REMOVE_CONFIRM;?>',function(r){
					if (r){
						$.post('_grupos.php',{id:id,actionGroups:'borra'},function(result){
							if (result.success){
								loadTable('json');
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
						loadTable('json');
						$('#id_group').combobox('reload');
					}
				});
			}
		}
		//Campaigns functions
		function newCampaign(){
			$('#dlcampaigns').dialog('open').dialog('setTitle','<?php echo CAMPAIGNS_NEW_TITLE;?>');
			$('#fmcampaigns').form('clear');
			$('#actionCampaigns').val('new');
			url = '_campaigns.php?iduser=<?php echo $_SESSION['id_user'];?>';
		}
		function editCampaign(id){
			if (id){
				$('#dlcampaigns').dialog('open').dialog('setTitle','<?php echo CAMPAIGNS_EDIT_TITLE;?>');
				$('#fmcampaigns').form('load','_campaigns.php?actionCampaigns=load&idcampaign='+id);
				$('#actionCampaigns').val('edit');
				$('#astatus').combobox({
							onLoadSuccess: function(param){
								if($('input[name="status"]').val()==3){
									$('#conStatus').hide();
								}else{
									$('#conStatus').show();
								}
							}
				});
				url = '_campaigns.php?id='+id;
			}
		}
		function saveCampaign(){
			$('#fmcampaigns').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success:function(data){  
					$('#dlcampaigns').dialog('close');
					loadTable('json');
					$('#datos').load('includes/campaign_detail.php?id='+data);
					
				}  
			});

		}
		function removeCampaign(id){
			if (id){
				$.messager.confirm('Confirm','<?php echo CAMPAIGNS_REMOVE_CONFIRM;?>',function(r){
					if (r){
						$.post('_campaigns.php',{id:id,actionCampaigns:'borra'},function(result){
							if (result.success){
								loadTable('json');
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		}
	</script>
<fieldset><legend><?php echo CAMPAIGNS_FORM_TITLE;?></legend></fieldset>
<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newGroup()"><?php echo GROUPS_NEW;?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newCampaign()"><?php echo CAMPAIGNS_NEW;?></a>
	</div>
	<table id="tablaGrupos">
			<tr>
				<th><?php echo GROUPS_COL_NAME;?></th>
				<th><?php echo GROUPS_COL_DESCRIPTION;?></th>
				<th><?php echo GROUPS_COL_BUDGET;?></th>
				<th><?php echo GROUPS_COL_STATUS;?></th>
				<th>-</th>
				<th>-</th>
				<th>-</th>
			</tr>
	</table>
	
	
	<div id="dlgroups" class="easyui-dialog" style="width:500px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlgroups-buttons">
		<div class="ftitle"><?php echo GROUPS_FORM_SUBTITLE;?></div>
		<form id="fmgroups" method="post" novalidate>
			<div class="fitem">
				<label><?php echo GROUPS_COL_NAME;?>:</label>
				<input name="name" class="easyui-validatebox" required="required">
			</div>
			<div class="fitem">
				<label><?php echo GROUPS_COL_DESCRIPTION;?>:</label>
				<input name="description">
			</div>
			<!--
			<div class="fitem">
				<label><?php //echo GROUPS_COL_BUDGET;?>:</label>
				<input name="budget">
			</div>
			-->
				<input name="statusgroup" type="hidden" value="3">

			<input type="hidden" name="actionGroups" id="actionGroups" value="json">
			<input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_user'];?>">
			
		</form>
	</div>
	<div id="dlgroups-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveGroup()"><?php echo BUTTON_SAVE;?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgroups').dialog('close')"><?php echo BUTTON_CANCEL;?></a>
	</div>
	
	<div id="dlcampaigns" class="easyui-dialog" style="width:500px;padding:10px 20px"
			closed="true" buttons="#dlcampaigns-buttons">
		<div class="ftitle"><?php echo CAMPAIGNS_FORM_SUBTITLE;?></div>
		<form id="fmcampaigns" method="post" novalidate>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_NAME;?>:</label>
				<input name="name" class="easyui-validatebox" required="true">
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_DESCRIPTION;?>:</label>
				<input name="description">
			</div>
			<div class="fitem" id="conStatus">
				<label><?php echo CAMPAIGNS_COL_STATUS;?>:</label>
				<input class="easyui-combobox" id="astatus" name="status" 
					data-options="  
								url:'includes/json_status.php',  
								valueField:'id_status',  
								textField:'<?php echo SELECT_TEXTO_STATUS;?>'">  
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
				<input class="easyui-combobox" name="id_group" id="id_group"   
					data-options="  
								url:'_grupos.php?actionGroups=json',  
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
							data: [{label: '2',value: 'cpc'},{label: '3',value: 'cpm'}]">  
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_DATE_START;?>:</label>
				<input id="dstart" name="date_start" type="text" class="easyui-datebox" required="required"></input> 
			</div>
			<div class="fitem">
				<label><?php echo CAMPAIGNS_COL_DATE_END;?>:</label>
				<input id="dend" name="date_end" type="text" class="easyui-datebox" required="required"></input> 
			</div>
	
			<input type="hidden" name="actionCampaigns" id="actionCampaigns" value="">
			<input type="hidden" name="valforstatus" id="valforstatus" value="">
		</form>
	</div>
	<div id="dlcampaigns-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveCampaign()"><?php echo BUTTON_SAVE;?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlcampaigns').dialog('close')"><?php echo BUTTON_CANCEL;?></a>
	</div>
	<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
	<script>
        userId= $('input[name="id_user"]').val();
		vaction= $('input[name="actionGroups"]').val();
		loadTable(vaction);
function loadTable(vaction){
	//$("#tablaGrupos").empty();
	$( "#tablaGrupos tr td" ).each( function(){
  this.parentNode.removeChild( this ); 
});
	$.ajax({
		type: "POST",
		url: "_grupos.php",
		data: { actionGroups: vaction },
		dataType: 'json'
	}).done(function( result ) {
			var table = $("#tablaGrupos");
			
			$.each(result,function(rowId,data) {
				
				$('#tablaGrupos tr:last').after(
					'<tr id="grp'+rowId+'" class="RowGroup">'+
						'<td field="name" onclick="showCampaign(cmp'+rowId+')" class="NameGroup">'+data['name']+'</td>'+
						'<td field="description">'+data['description']+'</td>'+
						'<td>&nbsp</td>'+
						'<td field="status">'+data['status']+'</td>'+
						'<td><img src="css/icons/pencil.png" title="<?php echo GROUPS_EDIT;?>" onclick="editGroup('+data['id_group']+')"></td>'+
						'<td><img src="css/icons/no.png" title="<?php echo GROUPS_REMOVE;?>" onclick="removeGroup('+data['id_group']+')"></td>'+
						'<td>&nbsp</td>'+
					'</tr>'
				);
				$.each(data['Campaigns'],function(key,data2) {
					if(data2['name']!=undefined){
						$('#tablaGrupos tr:last').after(
							'<tr id="cmp'+rowId+'" class="RowCampaign">'+
							'<td>'+data2['name']+'</td>'+
							'<td>'+data2['description']+'</td>'+
							'<td>'+data2['cap']+'</td>'+
							'<td>'+data2['status']+'</td>'+
							'<td><img src="css/icons/pencil.png" title="<?php echo CAMPAIGNS_EDIT;?>" onclick="editCampaign('+data2['id_campaign']+')"></td>'+
							'<td>&nbsp</td>'+
							'<td><img src="css/icons/search.png" title="<?php echo CAMPAIGNS_DETAIL;?>" onclick="javascript:$(\'#datos\').load(\'includes/campaign_detail.php?id='+data2['id_campaign']+'\');return false;"></td>'+
							'</tr>'
						);
					}
				});
			});
	});
}
function showCampaign(id){
	$(id).toggle('fast');
}     
    
	</script>