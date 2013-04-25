<?php 
require_once 'BaseDeDatos.php'; 
require_once 'MySQL.php'; 
require_once 'Sql.php';
require_once 'constantes.php';

class Banner 
{ 
	private $_id_banner;
	private $_name; 
	private $_filename;
	private $_thumbnail;
	private $_extension;
	private $_size;
	private $_date;

	public function __construct($pName)
	{
		$this->_name=$pName;
	}
	
	public function getBannersCampaign($pid_campaign){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "select count(*) from ssv_campaigns_banners where id_campaign=$pid_campaign";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			$result["total"] = $res[0];
			
			$consulta = "SELECT b.* 
							FROM ssv_campaigns_banners c
							LEFT JOIN ssv_banners b
							ON c.id_banner=b.id_banner 
							WHERE c.id_campaign=$pid_campaign";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		
			$items = array();
			$resultado='';
			foreach($res as $key=>$value){
				$resultado.='<li title="Click to remove: '.$value['thumbnail'].'"><img src="files/'.$value['thumbnail'].'" onclick="remImg(this.id);" id="img'.$value['id_banner'].'"></li>';
			}
		}catch(Exception $e){
			echo 'Error: '.$e->getMessage();
		}
		return $resultado;

	}
	
	public function getBanner($id){
		$this->_id_banner=$id;
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			
			$consulta = "SELECT * FROM ssv_banners WHERE id_banner=$id";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			$items = array();
			foreach($res as $key=>$value){
				$this->_name=$value['name'];
				$this->_filename=$value['filename'];
				$this->_thumbnail=$value['thumbnail'];
				$this->_extension=$value['extension'];
				$this->_size=$value['size'];
				$this->_date=$value['date'];
			}
			
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return $this;
	}
	
	public function verifySize($size){
		$this->_size=$size;
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			
			$consulta = "SELECT count(size) as existe FROM ads_banners_size WHERE size='$size'";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			if(isset($res[0]) && $res[0]['existe']>0){
				return true;
			}else{
				return false;
			}
		}catch(Exception $e){
			die('Error: '.$e->getMessage());
		}
	}
	
	public function addBanner($pidUser, $pName, $pFileName, $pThumbnail, $pExtension, $pSize){
		try{
			$MySQL=new MySQL();
			$bd = new BaseDeDatos($MySQL); 
			$sql = new Sql();  
			$consulta = "insert into ssv_banners 
								(id_user, name, filename, thumbnail, extension, size, date) 
								values (
								$pidUser, '$pName', '$pFileName', '$pThumbnail', '$pExtension', '$pSize', now())";
			$sql->generar($consulta);
			$res = $bd->modificar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return $res;
	}
		
	public function setCampaign($pid_campaign, $pid_banner, $pextension){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "INSERT INTO ssv_campaigns_banners 
							(id_campaign, id_banner, extension) VALUES  
							($pid_campaign, $pid_banner, '$pextension')";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return true;
	}
	
	public function clearCampaign($pid, $pidcampaign){
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "DELETE FROM ssv_campaigns_banners WHERE id_banner=$pid and id_campaign=$pidcampaign";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
		}catch(Exception $e){
			return 'Error: '.$e->getMessage();
		}
		return $consulta;
	}
	
	public function __toString() 
	{ 
		return $this->_name; 
	} 
}