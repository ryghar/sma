<?php 
require_once 'BaseDeDatos.php'; 
require_once 'MySQL.php'; 
require_once 'Sql.php';
require_once 'constantes.php';
require_once('idioma.php');

class Grupo 
{ 
	private $_name; 
	private $_description;
	private $_budget;
	private $_status;
	private $_date;

	public function __construct()
	{
		$this->_status=3;
		$this->_budget=0;
	}
	
	public function getGruposUsuario($pid, $ppage, $prows, $poffset){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "select count(*) from ssv_groups where id_user=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			$result["total"] = $res[0];
			
			$consulta = "select * from ssv_groups where id_user=$pid limit $poffset,$prows";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		
			$items = array();
			foreach($res as $key=>$value){
				array_push($items, $value);
			}
		}catch(Exception $e){
			echo 'Error: '.$e->getMessage();
		}
		$result["rows"] = $items;
		return json_encode($result);

	}
	
	public function getGruposJson($pid){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
	
			$consulta = "SELECT g.id_group, g.name, g.description, g.budget, s.name_eng as status
						 FROM ssv_groups g 
						 LEFT JOIN ssv_status s ON g.status=s.id_status 
						 WHERE g.id_user=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		
			$items = array();
			foreach($res as $key=>$value){
				$grupo=$value['id_group'];
				$sqlCampaign = new Sql();  
				$consultaCampaign = "SELECT c.id_campaign, c.id_user, c.id_group, c.id_country, c.id_cat_theme, c.model_rate, c.name, c.description, c.url, c.bid, c.cap, s.name_eng as status, c.date_start, c.date_end 
									 FROM ssv_campaigns c 
									 LEFT JOIN ssv_status s on c.status=s.id_status 
									 WHERE c.id_group=$grupo";
				$sqlCampaign->generar($consultaCampaign);
				$resCampaign = $bd->ejecutar($sqlCampaign);
				$Campaigns = array();
				foreach($resCampaign as $keyCampaign=>$valueCampaign){
					array_push($Campaigns, $valueCampaign);
				}
				//$campaigns=array('c1'=>'este1','c2'=>'este2');
				$value['Campaigns']=$Campaigns;
				array_push($items, $value);
			}
		}catch(Exception $e){
			echo 'Error: '.$e->getMessage();
		}
		return json_encode($items);
	}
	
	public function getGrupo($id){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$result["total"] = 1;
			
			$consulta = "select * from ssv_groups where id_group=$id";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		
			$items = array();
			foreach($res as $key=>$value){
				array_push($items, $value);
			}
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		$result["rows"] = $items;
		return json_encode($result);

	}
	
	public function getGrupoLoad($id){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
		
			$consulta = "select * from ssv_groups where id_group=$id";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		
			$items = array();
			foreach($res as $key=>$value){
				array_push($items, $value);
			}
		}catch(Exception $e){
			echo 'Error: '.$e->getMessage();
		}

		$items=json_encode($items);
		$items=substr($items,1,-1);
		return $items;
	}
	
	public function addGrupo($pid_user, $pname, $pdescription, $pbudget, $pstatus){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "insert into ssv_groups (id_user, name, description, budget, status) values ($pid_user, '$pname', '$pdescription', '$pbudget', '$pstatus')";

			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return json_encode(array('success'=>true));
	}
	
	public function setGrupo($pid, $pname, $pdescription, $pbudget, $pstatus){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "update ssv_groups set name='$pname', description='$pdescription', budget='$pbudget', status='$pstatus' where id_group=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return json_encode(array('success'=>true));

	}
	
	public function delGrupo($pid){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			
			$consulta = "select count(*) as totrows from ssv_campaigns where id_group=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			if($res[0]['totrows']>0){return json_encode(array('success'=>false, 'msg'=>GROUPS_ERROR_ENUSO));exit;}
			$consulta = "delete from ssv_groups where id_group=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return json_encode(array('success'=>true));
	}

	public function __toString() 
	{ 
		return $this->_name; 
	} 
}