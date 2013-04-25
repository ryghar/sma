<?php
ob_start();
session_start();
require_once('constantes.php');
require_once('idioma.php');
require_once('usuario.php');
$Usuario=new Usuario;
$UsuarioDatos=$Usuario->getUsuario($_SESSION['id_user']);
$FechaDesde=date('m/d/Y',strtotime('-1 MONTH'));
$FechaHasta=date('m/d/Y');
?>

<fieldset><legend><?php echo STATICS_FORM_TITLE;?></legend></fieldset>
	<div class="fitem">
		<label><?php echo CAMPAIGNS_COL_DATE_START;?>:</label>
		<input id="dstart" name="date_start" type="text" class="easyui-datebox"></input> 
	</div>
	<div class="fitem">
		<label><?php echo CAMPAIGNS_COL_DATE_END;?>:</label>
		<input id="dend" name="date_end" type="text" class="easyui-datebox"></input> 
	</div>
	<div id="dlgroups-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="loadTable()"><?php echo BUTTON_UPDATE;?></a>
</div>

	<table id="tablaStatics">
			<tr>
				<th><?php echo GROUPS_COL_NAME;?></th>
				<th><?php echo CAMPAIGNS_COL_NAME;?></th>
				<th><?php echo CAMPAIGNS_COL_STATUS;?></th>
				<th>CTR</th>
				<th>Clics</th>
				<th><?php echo STATICS_COL_SPENT;?></th>
				<th>-</th>
				<th>-</th>
			</tr>
	</table>
	<div id="chart_div" style="width: 500px; height: 300px;"></div>
	<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
	<script>
	
	$('#dstart').datebox({  
		required:true,
		currentText: '<?php echo STATICS_CALENDAR_TODAY;?>'
	}); 
	$('#dstart').datebox('setValue','<?php echo $FechaDesde;?>');
	$('#dend').datebox('setValue','<?php echo $FechaHasta;?>');

	loadTable();
	
	function loadTable(){
		var FechaDesde = $('#dstart').datebox('getValue');
		var FechaHasta = $('#dend').datebox('getValue');
		$( "#tablaStatics tr td" ).each( function(){
			this.parentNode.removeChild( this ); 
		});
		$.ajax({
			type: "POST",
			url: "_statics.php",
			data: { desde: FechaDesde, hasta: FechaHasta },
			dataType: 'json'
		}).done(function( result ) {
			var table = $("#tablaStatics");
			var totalCtr=totalClics=totalSpent=0;
			dataGra=new Array(); 
			totalDia=new Array();
			headerGra=new Array('Day','Clics');
			dataGra.push(headerGra);
			$.each(result,function(rowId,data) {
				if(data['grupo']){
				totalCtr+=parseFloat(data['ctr']);
				totalClics+=parseFloat(data['clics']);
				totalSpent+=parseFloat(data['spent']);
				$('#tablaStatics tr:last').after(
					'<tr id="grp'+rowId+'" class="RowGroup">'+
						'<td field="grupo">'+data['grupo']+'</td>'+
						'<td field="campaign">'+data['campaign']+'</td>'+
						'<td field="status">'+data['status']+'</td>'+
						'<td field="ctr">'+data['ctr']+'</td>'+
						'<td field="clics">'+data['clics']+'</td>'+
						'<td field="spent">'+data['spent']+'</td>'+

					'</tr>'
				);
				var pepe=data['date'].replace('-','');
				var pepe=pepe.replace('-','');
				if(totalDia[pepe]==undefined){totalDia[pepe]=0;}
				totalDia[pepe]+=parseFloat(data['clics']);
				}
			});
			for(var key in totalDia) {
				parValor=new Array(key,parseFloat(totalDia[key]));
				dataGra.push(parValor);
			}
			drawChart(dataGra);

			$('#tablaStatics tr:last').after(
					'<tr class="RowTotal">'+
						'<td colspan="3">Total</td>'+
						'<td field="ctr">'+totalCtr+'</td>'+
						'<td field="clics">'+totalClics+'</td>'+
						'<td field="spent">'+totalSpent+'</td>'+

					'</tr>'
			);

	});
	
}
</script>

    <script type="text/javascript">

      function drawChart(pepe) {
        var data = google.visualization.arrayToDataTable(pepe);

        var options = {
          title: 'Clics Performance'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>    
