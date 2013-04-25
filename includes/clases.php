<?php
require_once 'BaseDeDatos.php'; 
require_once 'MySQL.php'; 
require_once 'Sql.php';
//Clases de ayuda
class ListaCombo 
{
	var $Query;
    var $Id;
    var $Desc;
    var $Desc2;
    var $ComparaValor;

    function getCombo(){
		$bd = new BaseDeDatos(new MySQL()); 
		$sql = new Sql();  
        $query_Combo = $this->Query;
		$sql->generar($query_Combo);
		$res = $bd->ejecutar($sql);
		foreach($res as $key=$row_Combo){
			if($this->Desc2!=''){$ShowDesc2=', ' . substr($row_Combo[$this->Desc2],0,30);}else{$ShowDesc2='';}
			if($row_Combo[$this->Id]==$this->ComparaValor){$CV="selected";} else {$CV='';}
			echo "<option value=" . $row_Combo[$this->Id] . ' ' . $CV .">" . substr($row_Combo[$this->Desc],0,30) . $ShowDesc2 . "</option>";
		}
	}