<?php
//Proceso de grupos
ob_start();
session_start();
require_once('includes/Campaign.php');
if(isset($_REQUEST['actionCampaigns'])){
	$Action=$_REQUEST['actionCampaigns'];

	switch($Action){
		case 'edit':	$Campaign=new Campaign();	
						$id = intval($_REQUEST['id']);
						$name = $_REQUEST['name'];
						$description = $_REQUEST['description'];
						$country = $_REQUEST['id_country'];
						$status = $_REQUEST['status'];
						$grupo = $_REQUEST['id_group'];
						$url = $_REQUEST['url'];
						$bid = $_REQUEST['bid'];
						$cap = $_REQUEST['cap'];
						$model = $_REQUEST['model_rate'];
						$dstart = $_REQUEST['date_start'];
						$dend = $_REQUEST['date_end'];
						$Result=$Campaign->setCampaign($id, $name, $description, $country, $status, $grupo, $url, $bid, $cap, $model, $dstart, $dend);
						echo $Result;
						break;
		case 'new':		$Campaign=new Campaign();	
						$id_user=intval($_REQUEST['iduser']);
						$name = $_REQUEST['name'];
						$description = $_REQUEST['description'];
						$country = $_REQUEST['id_country'];
						$status = $_REQUEST['status'];
						$grupo = $_REQUEST['id_group'];
						$url = $_REQUEST['url'];
						$bid = $_REQUEST['bid'];
						$cap = $_REQUEST['cap'];
						$model = $_REQUEST['model_rate'];
						$dstart = $_REQUEST['date_start'];
						$dend = $_REQUEST['date_end'];
						$Result=$Campaign->addCampaign($id_user, $name, $description, $country, 3, $grupo, $url, $bid, $cap, $model, $dstart, $dend);
						echo $Result;
						break;
		case 'lista':	$Campaign=new Campaign();
						$id_user=intval($_SESSION['id_user']);
						$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
						$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
						$offset = ($page-1)*$rows;
						$Result=$Campaign->getCampaignsUsuario($id_user, $page, $rows, $offset);
						echo $Result;
						break;
		case 'borra':	$Campaign=new Campaign();
						$id_campaign=intval($_REQUEST['id']);
						$Result=$Campaign->delCampaign($id_campaign);
						echo $Result;
						break;
		case 'json':	$Campaign=new Campaign();
						if(isset($_REQUEST['grupo'])){
							$grupo=$_REQUEST['grupo'];
							$Result=$Campaign->getGruposJson($grupo);
							echo $Result;
						}
						break;
		case 'load':	if(isset($_REQUEST['idcampaign'])){
							$Campaign=new Campaign();
							$id_campaign=intval($_REQUEST['idcampaign']);
							$Result=$Campaign->getCampaignLoad($id_campaign);
							echo $Result;
						}
						break;
	}
}


