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
		function newGroup(){
			$('#dlg').dialog('open').dialog('setTitle','<?php echo GROUPS_NEW_TITLE;?>');
			$('#fm').form('clear');
			$('#action').val('new');
			url = '_grupos.php?iduser=<?php echo $_SESSION['id_user'];?>';
		}
		function editGroup(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','<?php echo GROUPS_EDIT_TITLE;?>');
				$('#fm').form('load',row);
				$('#action').val('edit');
				url = '_grupos.php?id='+row.id_group;
				//console.dir(row);
			}
		}
		function saveGroup(){
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
		function removeGroup(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','<?php echo GROUPS_REMOVE_CONFIRM;?>',function(r){
					if (r){
						$.post('_grupos.php',{id:row.id_group,action:'borra'},function(result){
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
					}
				});
			}
		}
	</script>
<fieldset><legend><?php echo GROUPS_FORM_TITLE;?></legend></fieldset>
	<table id="dg"></table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newGroup()"><?php echo GROUPS_NEW;?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editGroup()"><?php echo GROUPS_EDIT;?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeGroup()"><?php echo GROUPS_REMOVE;?></a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:500px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle"><?php echo GROUPS_FORM_SUBTITLE;?></div>
		<form id="fm" method="post" novalidate>
			<div class="fitem">
				<label><?php echo GROUPS_COL_NAME;?>:</label>
				<input name="name" class="easyui-validatebox" required="required">
			</div>
			<div class="fitem">
				<label><?php echo GROUPS_COL_DESCRIPTION;?>:</label>
				<input name="description">
			</div>
			<div class="fitem">
				<label><?php echo GROUPS_COL_BUDGET;?>:</label>
				<input name="budget">
			</div>
			<div class="fitem">
				<label><?php echo GROUPS_COL_STATUS;?>:</label>
				<input class="easyui-combobox" name="status" 
								data-options="  
								url:'includes/json_status.php',  
								valueField:'id_status',  
								textField:'<?php echo SELECT_TEXTO_STATUS;?>',  
								panelHeight:'auto'
				">
			</div>
			<input type="hidden" name="action" id="action" value="">
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveGroup()"><?php echo BUTTON_SAVE;?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')"><?php echo BUTTON_CANCEL;?></a>
	</div>
	<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
	<script>
	$('#dg').datagrid({  
		url:'_grupos.php',  
		columns:[[  
			{field:'name',title:'<?php echo GROUPS_COL_NAME;?>',width:100},  
			{field:'description',title:'<?php echo GROUPS_COL_DESCRIPTION;?>',width:100},  
			{field:'budget',title:'<?php echo GROUPS_COL_BUDGET;?>',width:100,align:'right'},
			{field:'status',title:'<?php echo GROUPS_COL_STATUS;?>',width:100,align:'right'}
		]],
		toolbar: '#toolbar',
		queryParams: {
			action: 'lista',
			subject: 'datagrid'
		}
	}); 
	</script>