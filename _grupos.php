<?php
//Proceso de grupos
ob_start();
session_start();
require_once('includes/Grupo.php');

if(isset($_REQUEST['actionGroups'])){
	$Action=$_REQUEST['actionGroups'];
	

	switch($Action){
		case 'edit':	$Grupo=new Grupo();	
						$id = intval($_REQUEST['id']);
						$name = $_REQUEST['name'];
						$description = $_REQUEST['description'];
						$budget = $_REQUEST['budget'];
						$status = $_REQUEST['statusgroup'];
						$Result=$Grupo->setGrupo($id, $name, $description, $budget, 3);
						echo $Result;
						break;
		case 'new':		$Grupo=new Grupo();	
						$id_user=intval($_REQUEST['iduser']);
						$name = $_REQUEST['name'];
						$description = $_REQUEST['description'];
						if(isset($_REQUEST['budget'])){$budget = $_REQUEST['budget'];}else{$budget='';}
						$status = $_REQUEST['statusgroup'];
						$Result=$Grupo->addGrupo($id_user, $name, $description, $budget, 3);
						echo $Result;
						break;
		case 'lista':	$Grupo=new Grupo();
						$id_user=intval($_SESSION['id_user']);
						$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
						$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
						$offset = ($page-1)*$rows;
						$Result=$Grupo->getGruposUsuario($id_user, $page, $rows, $offset);
						echo $Result;
						break;
		case 'borra':	$Grupo=new Grupo();
						$id_grupo=intval($_REQUEST['id']);
						$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
						$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
						$offset = ($page-1)*$rows;
						$Result=$Grupo->delGrupo($id_grupo);
						echo $Result;
						break;
		case 'json':	$Grupo=new Grupo();
						$id_user=intval($_SESSION['id_user']);
						$Result=$Grupo->getGruposJson($id_user);
						echo $Result;
						break;
		case 'load':	if(isset($_REQUEST['idgroup'])){
							$Grupo=new Grupo();
							$id_grupo=intval($_REQUEST['idgroup']);
							$Result=$Grupo->getGrupoLoad($id_grupo);
							echo $Result;
						}
						break;
	}
}else{
echo 'no';
}


