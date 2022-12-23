<?php
include 'read_file.php';
// Desactivar toda las notificaciónes del PHP

error_reporting(0);

 
// Notificar solamente errores de ejecución

error_reporting(E_ERROR | E_WARNING | E_PARSE);


error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);


// Mostrar todos los errores menos el E_NOTICE

// Valor predeterminado ya descrito en php.ini

error_reporting(E_ALL ^ E_NOTICE);


//Notificar todos los errores de PHP

error_reporting(E_ALL);


// Notificar todos los errores de PHP
error_reporting(-1);

 

// Lo mismo que error_reporting(E_ALL);

ini_set('error_reporting', E_ALL);

function validarSintaxisUrl($url_){
	if($url_){
		
		$urlparts= parse_url($url_);
		//echo("<pre>");
		//print_r($urlparts);
		//echo($url);
		//echo("<pre>");
		//print_r($urlparts);
		//echo("</pre>");
		if(isset($urlparts['scheme'])){
			$scheme = $urlparts['scheme'];

			if ($scheme === 'https') {
				///echo("$url es una URL valida");
				return true;
			} else {
				//echo("$url no es una URL valida");
				return false;
			}
		}
		else {
			return false;
		}
	}
}
$accion = $_REQUEST['accion'];
$filename="urls.txt";

if($accion=='cargar'){
	
	if($_REQUEST['url']){
		$url = $_REQUEST['url'];
		//echo($url);
		$rpta = validarSintaxisUrl($url);
		if($rpta){
			$fpmy =fopen($filename, "a+");
			$con = fwrite($fpmy,$url."\n");
			fclose($fpmy);
			//$contents = fread($fp,filesize($filename));
			//echo($contents);
		}
		else {
			echo("<p style='color:red;'>El url es incorrecto</p>");
		}
	}
	
	if (is_array($_FILES) && count($_FILES) > 0) {
	
		$file = $_FILES['file']['name'];
		
		$fp=fopen($_FILES['file']['tmp_name'],"r");
		
		if(!$fp){
				
			echo("El archivo no subio correctamente");
				
		}
		//echo("ingrese");
		while (!feof($fp)) {
			$url = fgets($fp);
			//echo($url);
			//if($url==' '){
			//echo("ok".$url);
			 $rpta = validarSintaxisUrl($url);
			 if($rpta){
				//$rpta_validacion=validarCertificados($url);
				$fpmy =fopen($filename, "a+");
				$conmy = fwrite($fpmy,$url);
				fclose($fpmy);
			 }
			 else {
				echo("<p style='color:red;'>El url es incorrectdddddo: </p>".$url);
			}
			//}
		}
		
		fclose($fp);
	}
	
	
	/* Leemos el archivo guardado de todos los url */
	
	$fp=fopen($filename,"r");
	
	if(!$fp){			
		echo("El archivo no subio correctamente");			
	}
	?>
	<table border=1>
	<thead>
		<tr>
		<th width=50px> Link</th>
		<th width=50px> Url</th>
		<th> <img src="img/Microsoft_Edge_logo.png" alt="Microsoft Edge"> </th>
		<th> <img src="img/firefox.png" alt="Microsoft Edge"></th>
		<th> <img src="img/chrome.png" alt="Microsoft Edge"></th>
		<th> Mensaje</th>
	</thead>	
	<?php
	while (!feof($fp)) {
		$url = fgets($fp);
		?>
		<tr> 
			 <td>
			 <a href="get_cer_url_2.php?url=<?php echo($url) ?>"><img src="img/mas.png"> </a>
			 </td>
			 <td>
			 <?php
			 echo($url);
			 ?>
			 </td>
			 <td>
			  <?php
				$rpta_validacion=validarCertificadoEdge($url);
			 
			 if($rpta_validacion){
			 ?>
			 <img src="img/verde.png"> 
			 <img src="img/verde.png">
			 <img src="img/verde.png">
			 <?php 
			 }
			 else {
			 
			 ?>
			 <img src="img/verde.png"> 
			 <img src="img/verde.png">
			 <img src="img/blanco.png"> 
			 <?php
			 }
			 ?>
			 </td>
			 <td>
			  <?php
				$rpta_validacion=validarCertificadofirefox($url);
			 
			 if($rpta_validacion){
			 ?>
			 <img src="img/verde.png"> 
			 <img src="img/verde.png">
			 <img src="img/verde.png">
			 <?php 
			 }
			 else {
			 
			 ?>
			 <img src="img/verde.png"> 
			 <img src="img/verde.png">
			 <img src="img/blanco.png"> 
			 <?php
			 }
			 ?>
			 </td>
			 <td> 
			 <?php
			 $rpta_validacion=validarCertificadoChrome($url);
			 if($rpta_validacion){
			 ?>
			 <img src="img/verde.png"> 
			 <img src="img/verde.png">
			 <img src="img/verde.png">
			 <?php 
			 }
			 else {
			 
			 ?>
			 <img src="img/verde.png"> 
			 <img src="img/verde.png">
			 <img src="img/blanco.png"> 
			 <?php
			 }
			 ?>
			 </td>
			 </tr>
		<?php
	}
	fclose($fp);
	
	
}
if($accion=='limpiar'){
	//echo($accion);
	$fp =fopen($filename, "r+");
	ftruncate($fp, 0);
	//close file
	fclose($fp);
}

?>