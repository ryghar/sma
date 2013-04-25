<?php 
require_once 'BaseDeDatos.php'; 
require_once 'MySQL.php'; 
require_once 'Sql.php';
require_once DOCROOT.'/lib/swift/swift_required.php';
require_once 'constantes.php';

class Usuario 
{ 
	private $_email; 
	private $_nombre;
	private $_password;
	private $_pais;
	private $_empresa;
	private $_telefono;
	private $_direccion;
	private $_cpostal;
	private $_balance;

	public function __construct()
	{
		$this->_email=NULL;
		$this->_password=NULL;
	}
	public function registro($pEmail,$pNombre,$pPassword,$pPais) 
	{ 
		if($this->validaEmail($pEmail)){
			$this->_email=$pEmail;
			$this->_nombre=$pNombre;
			$this->_password=base64_encode($pPassword);
			$this->_pais=$pPais;
			$conCode = md5(uniqid(rand(), true));
			$resultado='';
			try{
				$bd = new BaseDeDatos(new MySQL()); 
				$sql = new Sql();  
				$consulta = "INSERT INTO ads_users_web (name, commercial, email, phone, address, id_country, password, date, level, status, conCode)
					VALUES ('$this->_nombre', '', '$this->_email', '', '', $this->_pais, '$this->_password', now(), '1', '0', '$conCode')";
				$sql->generar($consulta);
				$bd->modificar($sql);
			}catch(Exception $e){
				//$resultado='Error: '.$e->getMessage();
				return '2';
			}
			$message = " To activate your account, please click on this link:\n\n";
            $message .= ROOT . '/startmeapp/_activa_usuario.php?email=' . urlencode($this->_email) . "&token=$conCode";
			try{
				$this->sendEmail($message);
			}catch(Exception $e){
				//$resultado='Error: '.$e->getMessage();
				return '3';
			}
			
			return '0'; 
		}else{
			return '1';
		}
	}
	
	public function valida($pEmail,$pToken) 
	{ 
		$this->_email=$pEmail;
		$resultado='';
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "UPDATE ads_users_web SET conCode=NULL where email='$pEmail' and conCode='$pToken'";
				$sql->generar($consulta);
				$bd->modificar($sql);
		}catch(Exception $e){
			$resultado='Error: '.$e->getMessage();
		}
		return true; 
	}
	
	public function validaEmail($email)
	{
		if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)){
			try{
				$bd = new BaseDeDatos(new MySQL()); 
				$sql = new Sql();  
				$consulta = "SELECT count(email) as existe FROM ads_users_web where email='$email' and conCode IS NOT NULL";
				$sql->generar($consulta);
				$res = $bd->ejecutar($sql);
				if($res[0]['existe']){
					$consulta = "DELETE FROM ads_users_web where email='$email' and conCode IS NOT NULL";
					$sql->generar($consulta);
					$res = $bd->ejecutar($sql);
					return true;
				}else{
					$consulta = "SELECT count(email) as existe FROM ads_users_web where email='$email' and conCode IS NULL";
					$sql->generar($consulta);
					$res = $bd->ejecutar($sql);
					if($res[0]['existe']){
						return false;
					}else{
						return true;
					}
				}
			}catch(Exception $e){
				echo 'Error: '.$e->getMessage();
			}
		}else{
			return false;
		}
	}
	
	public function validaUsuario($email,$password)
	{
		if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)){
			try{
				$passmd5=base64_encode($password);
				$bd = new BaseDeDatos(new MySQL()); 
				$sql = new Sql();  
				$consulta = "SELECT email,id_user FROM ads_users_web where email='$email' and password='$passmd5' and conCode is NULL";
				$sql->generar($consulta);
				$res = $bd->ejecutar($sql);
				if(isset($res[0]['email'])){
					$_SESSION['Usuario']=$res[0]['email'];
					$_SESSION['id_user']=$res[0]['id_user'];
					return '0';
				}else{
					return '1';
				}
			}catch(Exception $e){
				echo 'Error: '.$e->getMessage();
			}
		}else{
			return '2';
		}
	}
	
	private function sendEmail($message){
		mail($this->_email, 'Registration Confirmation', $message, 'From: noreply@dtalle.com.ar');
		/*
		$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
			->setUsername('gustest.000')
			->setPassword('trebolito');

		$mailer = Swift_Mailer::newInstance($transport);

		$message = Swift_Message::newInstance('Registration Confirmation')
			->setFrom(array('gustest.000@gmail.com' => 'StartMeApp'))
			->setTo(array('ryghar@gmail.com'))
			->setBody($message);

		if(!$result = $mailer->send($message)){
			return $result;
		}else{
			return '';
		}
		*/
		return true;
	}
	
	public function getUsuario($pId)
	{
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "SELECT * FROM ads_users_web where id_user=$pId";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			return $res;
		}catch(Exception $e){
			echo 'Error: '.$e->getMessage();
		}
	}
	
	public function setProfile($pNombre, $pEmpresa, $pTelefono, $pDireccion, $pCPostal, $pId) 
	{ 

		$resultado='';
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "UPDATE ads_users_web SET 
						name='$pNombre', 
						commercial='$pEmpresa', 
						phone='$pTelefono', 
						address='$pDireccion', 
						zip='$pCPostal' 
						WHERE id_user='$pId'";
				$sql->generar($consulta);
				$bd->modificar($sql);
		}catch(Exception $e){
			$resultado='Error: '.$e->getMessage();
		}
		return $resultado; 
	}

	public function setBalance($pId, $pAmount, $pRecv, $pSend, $pTrack) 
	{ 

		$resultado='';
		$flagError=false;
		$message='id:'.$pId.' Amount:'.$pAmount.' recv:'.$pRecv.' Send:'.$pSend.' Track:'.$pTrack;
		
		try{
			$bd = new BaseDeDatos(new MySQL()); 
			$sql = new Sql();  
			$consulta = "SELECT count(id_user) as existe FROM ssv_users_balance where ipn_track_id='$pTrack'";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			if($res[0]['existe']){
				$resultado.='Track ID duplicado';
				$flagError=true;
				mail('ryghar@gmail.com', 'Track ID duplicado', $message, 'From: noreply@dtalle.com.ar');
			}
			$consulta = "SELECT balance FROM ads_users_web where id_user=$pId";
			$sql->generar($consulta);
			$res = $bd->ejecutar($sql);
			$Balance=$res[0]['balance']+$pAmount;
			mail('ryghar@gmail.com', 'Balance:'.$Balance, $message, 'From: noreply@dtalle.com.ar');
			
			if($pRecv<>PAYPAL_BUSSINESS){$flagError=true;mail('ryghar@gmail.com', 'Mail distinto', $message, 'From: noreply@dtalle.com.ar');}
			if(!$flagError){ 
				
				$consulta = "UPDATE ads_users_web SET 
						balance='$Balance' 
						WHERE id_user=$pId";
				$sql->generar($consulta);
				$bd->modificar($sql);
				mail('ryghar@gmail.com', 'Sin error', '1', 'From: noreply@dtalle.com.ar');
				$consulta = "INSERT INTO ssv_users_balance (id_user, mode, amount, notes, date, ipn_track_id, paypal_email)
					VALUES ($pId, 1, '$pAmount', '', now(), '$pTrack', '$pSend')";
				$sql->generar($consulta);
				$bd->modificar($sql);
				mail('ryghar@gmail.com', 'Sin error', '2', 'From: noreply@dtalle.com.ar');
			}
		}catch(Exception $e){
			$resultado='Error: '.$e->getMessage();
			mail('ryghar@gmail.com', 'error', $resultado, 'From: noreply@dtalle.com.ar');
		}
		return $resultado; 
	}
	
	public function __toString() 
	{ 
		return $this->_nombre; 
	} 
}