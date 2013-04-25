<?php
ob_start();
session_start();
require_once('includes/constantes.php');
require_once('includes/Banner.php');
$id_user=$_SESSION['id_user'];

if (!@file_exists(UPLOADDIR)) {
	//destination folder does not exist
	die("Make sure Upload directory exist!");
}

if($_POST && isset($_FILES['mFile']))
{	
	if(!isset($_POST['filetitle']) || strlen($_POST['filetitle'])<1){
		//required variables are empty
		$_POST['filetitle']='unnamed';}
		
	if(!isset($_FILES['mFile'])){
		//required variables are empty
		die("File is empty!");}
	
	if($_FILES['mFile']['error']){
		//File upload error encountered
		die(upload_errors($_FILES['mFile']['error']));}
	
	$FileName			= strtolower($_FILES['mFile']['name']); //uploaded file name
	$FileTitle			= mysql_real_escape_string($_POST['filetitle']); // file title
	$ImageExt			= substr($FileName, strrpos($FileName, '.')); //file extension
	$Extension			= substr($ImageExt,1,10);
	$FileType			= $_FILES['mFile']['type']; //file type
	$FileSize			= $_FILES['mFile']["size"]; //file size
	$RandNumber   		= rand(0, 9999999999); //Random number to make each filename unique.
	$uploaded_date		= date("Y-m-d H:i:s");
	$id_campaign=$_POST['idcampaign'];
	if($FileType=='image/png'){
		$original = imagecreatefrompng($_FILES['mFile']["tmp_name"]);
	}elseif($FileType=='image/gif'){
		$original = imagecreatefromgif($_FILES['mFile']["tmp_name"]);
	}else{
		$original = imagecreatefromjpeg($_FILES['mFile']["tmp_name"]);
	}
	
	$thumb = imagecreatetruecolor(50,50); // Lo haremos de un tamaño 150x150
	$ancho = imagesx($original);
	$alto = imagesy($original);
	$size=$ancho.'x'.$alto;
	imagecopyresampled($thumb,$original,0,0,0,0,50,50,$ancho,$alto);
	
	
	switch(strtolower($FileType))
	{
		//allowed file types
		case 'image/png': //png file
		case 'image/gif': //gif file 
		case 'image/jpeg': //jpeg file
		case 'application/pdf': //PDF file
		case 'application/msword': //ms word file
		case 'application/vnd.ms-excel': //ms excel file
		case 'application/x-zip-compressed': //zip file
		case 'text/plain': //text file
		case 'text/html': //html file
			break;
		default:
			die('Unsupported File!'); //output error
	}
	
  
	//File Title will be used as new File name
	$NewFileName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), strtolower($FileTitle));
	$NewFileName = $NewFileName.'_'.$RandNumber.$ImageExt;
	$NewThumbName='th_'.$NewFileName;
	
	//Rename and save uploded file to destination folder.
	$Banner=new Banner($FileTitle);
	if($Banner->verifySize($size)){
		//die($size.'-----'.$Banner->verifySize($size));
		
		if(move_uploaded_file($_FILES['mFile']["tmp_name"], UPLOADDIR . $NewFileName )){
			imagejpeg($thumb,UPLOADDIR.$NewThumbName,90); // 90 es la calidad de compresión
			//die($FileTitle.'--'.$NewFileName.'--'.$NewThumbName.'--'.$ImageExt.'--'.$size);
			@$lastID=$Banner->addBanner($id_user, $FileTitle, $NewFileName, $NewThumbName, $Extension, $size);
			@$Banner->setCampaign($id_campaign, $lastID, $Extension);
			echo $NewThumbName.'@'.$lastID;
		}else{
			die('error uploading File!');
		}
	}else{
		die('Incorrect size!!');
	}
}

//function outputs upload error messages, http://www.php.net/manual/en/features.file-upload.errors.php#90522
function upload_errors($err_code) {
	switch ($err_code) { 
        case UPLOAD_ERR_INI_SIZE: 
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini'; 
        case UPLOAD_ERR_FORM_SIZE: 
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form'; 
        case UPLOAD_ERR_PARTIAL: 
            return 'The uploaded file was only partially uploaded'; 
        case UPLOAD_ERR_NO_FILE: 
            return 'No file was uploaded'; 
        case UPLOAD_ERR_NO_TMP_DIR: 
            return 'Missing a temporary folder'; 
        case UPLOAD_ERR_CANT_WRITE: 
            return 'Failed to write file to disk'; 
        case UPLOAD_ERR_EXTENSION: 
            return 'File upload stopped by extension'; 
        default: 
            return 'Unknown upload error'; 
    } 
} 
?>