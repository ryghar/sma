<?php
require_once 'BaseDeDatos.php'; 
require_once 'MySQL.php'; 
require_once 'Sql.php';
//Armo las funciones en una clase para identificar su origen
class Funciones
{
	// Detectar server para versión local o remota
	public static function domainName()
	{
		$serverName=$_SERVER['SERVER_NAME'];
		$serverNameParts=explode('.',$serverName);
		if(count($serverNameParts)<2){
			return $serverName;
		}else{
			return $serverNameParts[count($serverNameParts) - 2].'.'.$serverNameParts[count($serverNameParts) - 1];
		}
	}
	// Armar select
    public static function RenderCombo($nombre,$tabla,$campoId,$campoTexto,$orderBy, $defaultvalue='', $opcionAdicional="",$valueOpcionAdicional="",$onchange="", $class="")
	{
        $respuesta="<select name='$nombre' id='$nombre'";
        if($onchange!=''){
           $respuesta.=" onchange='".$onchange."'";
        }
		if($class!=''){
           $respuesta.=" class='".$class."'";
        }
        $respuesta.=">\n";
        if ($opcionAdicional!=''){
            $respuesta=$respuesta."<option value=".$valueOpcionAdicional.">".$opcionAdicional."</option>\n";
		}
		$bd = new BaseDeDatos(new MySQL()); 
		$sql = new Sql();  
        $consulta = "SELECT * FROM $tabla";
		if($orderBy!="")
           $consulta .= " ORDER BY " . $orderBy;
		$sql->generar($consulta);
		$res = $bd->ejecutar($sql);
        
		
		foreach($res as $Result){

            if ($Result[$campoId]==$defaultvalue){
                $respuesta=$respuesta."<option value=\"".$Result[$campoId]."\" selected>".$Result[$campoTexto]."</option>\n";
            }else{
                $respuesta=$respuesta."<option value=\"".$Result[$campoId]."\">".$Result[$campoTexto]."</option>\n";
			}
			
        }
		
        $respuesta=$respuesta."</select>\n";
        return $respuesta;
    }
	public static function getModelRate($id)
	{
		switch($id){
			case 0: $ModelRate='CPA';
					break;
			case 1: $ModelRate='CPC';
					break;
			case 2: $ModelRate='CPM';
					break;
		}
		return $ModelRate;
	}
}