<?php 
require_once 'BaseDeDatos.php'; 
require_once 'MySQL.php'; 
require_once 'Sql.php';
require_once 'constantes.php';

class Campaign 
{ 
	private $_id_campaign;
	private $_name; 
	private $_description;
	private $_bid;
	private $_cap;
	private $_status;
	private $_date;
	private $_id_user;
	private $_id_group;
	private $_id_country;
	private $_model_rate;
	private $_dateStart;
	private $_dateEnd;

	public function __construct()
	{
		$this->_status=3;
		$this->_bid=0;
		$this->_cap=0;
		$this->_model_rate=1;
	}
	
	public function getCampaignsUsuario($pid, $ppage, $prows, $poffset){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "select count(*) from ssv_campaigns where id_user=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			$result["total"] = $res[0];
			
			$consulta = "SELECT c.*,g.name as grupo, s.name_eng as statustxt 
							FROM ssv_campaigns c
							LEFT JOIN ssv_groups g
							ON c.id_group=g.id_group 
							LEFT JOIN ssv_status s
							ON c.status=s.id_status 
							WHERE c.id_user=$pid limit $poffset,$prows";
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
	
	public function getCampaign($id){
		$this->_id_campaign=$id;
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			
			$consulta = "SELECT c.*, g.name as grupo, p.country_eng as pais, s.name_eng as estado 
							FROM ssv_campaigns c 
							LEFT JOIN ssv_groups g on g.id_group=c.id_group 
							LEFT JOIN ads_countries p on p.id_country=c.id_country 
							LEFT JOIN ssv_status s on s.id_status=c.status 
							WHERE id_campaign=$id";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			$items = array();
			foreach($res as $key=>$value){
				array_push($items, $value);
			}
			
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		if(isset($items[0])){return $items[0];}else{return false;}
	}
	
	public function getCarriers($id){
		$this->_id_campaign=$id;
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			
			$consulta = "SELECT id_carrier  
							FROM ssv_campaigns_carriers  
							WHERE id_campaign=$id";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			$items = array();
			foreach($res as $key=>$value){
				array_push($items, $value);
			}
			
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		if(isset($items)){return $items;}else{return false;}
	}
	
	public function getBrands($id){
		$this->_id_campaign=$id;
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			
			$consulta = "SELECT id_brand  
							FROM ssv_campaigns_brands  
							WHERE id_campaign=$id";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			$items = array();
			foreach($res as $key=>$value){
				array_push($items, $value);
			}
			
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		if(isset($items)){return $items;}else{return false;}
	}
	
	public function getModels($id){
		$this->_id_campaign=$id;
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			
			$consulta = "SELECT id_model  
							FROM ssv_campaigns_models  
							WHERE id_campaign=$id";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			$items = array();
			foreach($res as $key=>$value){
				array_push($items, $value);
			}
			
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		if(isset($items)){return $items;}else{return false;}
	}
	
	public function getCategory($id){
		$this->_id_campaign=$id;
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			
			$consulta = "SELECT c.id_cat_theme, t.rel_category 
							FROM ssv_campaigns c 
							LEFT JOIN ads_categories_theme t 
							ON c.id_cat_theme=t.id_category
							WHERE c.id_campaign=$id";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			$id_category=$res[0]['id_cat_theme'];
			$rel_category=$res[0]['rel_category'];
			
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		if(isset($res[0])){return $res[0];}else{return false;}
	}
	
	public function getStatus($id){
		$this->_id_campaign=$id;
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			
			$consulta = "SELECT status 
							FROM ssv_campaigns 
							WHERE id_campaign=$id";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			$status=$res[0]['status'];
			
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return $status;
	}
	/*
	public function setBrand($pid, $pid_brand){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "UPDATE ssv_campaigns set 
							id_brand=$pid_brand 						 
							WHERE id_campaign=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return true;
	}
	public function setModel($pid, $pid_model){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "UPDATE ssv_campaigns set 
							id_model=$pid_model 						 
							WHERE id_campaign=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return true;
	}
	*/
	public function setCarrier($pid, $pid_carrier){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "INSERT INTO ssv_campaigns_carriers (id_campaign, id_carrier) VALUES ($pid, $pid_carrier)";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return true;
	}
	
	public function clearCarrier($pid){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "DELETE FROM ssv_campaigns_carriers WHERE id_campaign=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return true;
	}
	
	public function setBrand($pid, $pid_brand){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "INSERT INTO ssv_campaigns_brands (id_campaign, id_brand) VALUES ($pid, $pid_brand)";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return true;
	}
	
	public function clearBrand($pid){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "DELETE FROM ssv_campaigns_brands WHERE id_campaign=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return true;
	}
	
	public function setModel($pid, $pid_model){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "INSERT INTO ssv_campaigns_models (id_campaign, id_model) VALUES ($pid, $pid_model)";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return true;
	}
	
	public function clearModel($pid){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "DELETE FROM ssv_campaigns_models WHERE id_campaign=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return true;
	}
	
	public function setCategory($pid, $pid_category){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "UPDATE ssv_campaigns SET id_cat_theme=$pid_category WHERE id_campaign=$pid";
			$sql->generar($consulta);
			$res = $bd->modificar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return true;
	}
	
	public function addCampaign($pid_user, $pname, $pdescription, $pcountry, $pstatus, $pgrupo, $purl, $pbid, $pcap, $pmodel, $pdstart, $pdend){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$DateStart=strtotime($pdstart);
			$DateStart=date('Ymd',$DateStart);
			$DateEnd=strtotime($pdend);
			$DateEnd=date('Ymd',$DateEnd);
			$consulta = "insert into ssv_campaigns (
								id_user, id_group, id_country, id_cat_theme, model_rate, name, description, url, bid, cap, status, date_start, date_end) 
								values (
								$pid_user, $pgrupo, $pcountry, 1, $pmodel, '$pname', '$pdescription', '$purl', '$pbid', '$pcap', $pstatus, '$DateStart', '$DateEnd')";

			$sql->generar($consulta);
			$id_insert = $bd->modificar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return $id_insert;
	}
	
	public function setCampaign($pid, $pname, $pdescription, $pcountry, $pstatus, $pgrupo, $purl, $pbid, $pcap, $pmodel, $pdstart, $pdend){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$DateStart=strtotime($pdstart);
			$DateStart=date('Ymd',$DateStart);
			$DateEnd=strtotime($pdend);
			$DateEnd=date('Ymd',$DateEnd);
			$consulta = "UPDATE ssv_campaigns set 
							name='$pname', 
							description='$pdescription',
							id_country=$pcountry,
							status='$pstatus',
							id_group=$pgrupo,
							url='$purl',
							bid='$pbid',
							cap='$pcap',
							model_rate=$pmodel,
							date_start='$DateStart',
							date_end='$DateEnd' 							 
							WHERE id_campaign=$pid";
			$sql->generar($consulta);
			$res = $bd->modificar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return $pid;

	}
	
	public function delCampaign($pid){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "delete from ssv_campaigns where id_campaign=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return json_encode(array('success'=>true));
	}
	
	public function setAdsText($pid, $pTitle, $pDescription, $pUrl){
		try{
			$MySql=new MySQL();
			$bd = new BaseDeDatos($MySql); 
			$sql = new Sql();  
			$consulta = "INSERT INTO ssv_adtext (title, description, url) VALUES  
							('$pTitle', '$pDescription', '$pUrl')";
			$sql->generar($consulta);
			$id_insert = $bd->modificar($sql);
			$consulta = "INSERT INTO ssv_campaigns_adtext (id_campaign, id_adtext) VALUES  
							($pid, $id_insert)";
			$sql->generar($consulta);
			$res = $bd->modificar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return $id_insert;
	}
	
	public function getAdsTextCampaign($pid_campaign){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "select count(*) from ssv_campaigns_adtext where id_campaign=$pid_campaign";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			$result["total"] = $res[0];
			
			$consulta = "SELECT b.* 
							FROM ssv_campaigns_adtext c
							LEFT JOIN ssv_adtext b
							ON c.id_adtext=b.id_adtext 
							WHERE c.id_campaign=$pid_campaign";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		
			$items = array();
			$resultado='';
			foreach($res as $key=>$value){
				$resultado.='<tr id="txt'.$value['id_adtext'].'"><td>'.$value['title'].'</td><td>'.$value['description'].'</td><td>'.$value['url'].'</td><td  onclick="remTxt(txt'.$value['id_adtext'].');"><img src="css/icons/cancel.png"</td></tr>';
			}
		}catch(Exception $e){
			echo 'Error: '.$e->getMessage();
		}
		return $resultado;

	}
	
	public function clearadTxt($pid, $pidcampaign){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "DELETE FROM ssv_campaigns_adtext WHERE id_adtext=$pid and id_campaign=$pidcampaign";
			$sql->generar($consulta);
			$res = $bd->modificar($sql);
			$consulta = "DELETE FROM ssv_adtext WHERE id_adtext=$pid";
			$sql->generar($consulta);
			$res = $bd->modificar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return true;
	}
	
	public function getCampaignJson($pid){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
	
			$consulta = "select * from ssv_campaigns where id_group=$pid";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		
			$items = array();
			foreach($res as $key=>$value){
				array_push($items, $value);
			}
		}catch(Exception $e){
			echo 'Error: '.$e->getMessage();
		}
		return json_encode($items);
	}
	public function getCampaignLoad($id){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
		
			$consulta = "select * from ssv_campaigns where id_campaign=$id";
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

	public function __toString() 
	{ 
		return $this->_name; 
	} 
}