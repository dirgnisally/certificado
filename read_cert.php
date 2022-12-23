<?php
//include('Crypt/RSA.php');

function readCertificadosFile($name_file){
$certificados = array();
?>
<font face="Comic Sans MS,Arial,Verdana" size=8cm> <p >Moxilla TRust Store Certificates</p></font>
	<table border=1>
	<thead>
		<tr>
		<th colspan=8> Certificates:</th>
		
	</thead>
	<tbody>
	
	<?php
	
$i=0;
$entrar=2;
$linea_concatenada="";
if($file = fopen($name_file, "r")) {
	//$i=0;
    while(!feof($file)) {
        $line = fgets($file);
		//echo($line."Hola");
		//echo("<br>");
		/*if(strpos(trim($line), $inicio)) 
		{
			echo "String found";
		}
		*/
		if((trim($line) =='-----BEGIN CERTIFICATE-----' )&& ($entrar==2)){
			$entrar=1;
			//echo("entrar: ".$entrar."<br>");
		}
		else if ((trim($line)=="-----END CERTIFICATE-----") && ($entrar==1)){
			$linea_concatenada = $linea_concatenada.$line;
			
			
			$certificados[$i]=$linea_concatenada;
			$data = openssl_x509_parse($linea_concatenada);
		    // echo("<pre>");
			//print_r($data);
			//echo("</pre>");
			?>
			<tr><td><b>keyType</b></td>
				<td><?php echo($data['signatureTypeSN']);	?></td>
				<td><b>modulos</b></td>
				<td><?php echo($data['signatureTypeNID']);	?></td>
				<td><b>validTo</b></td>
				<td>
				<?php 
				//$validFrom = date('Y-m-d H:i:s', $data['validFrom_time_t']);
				$validTo = date('Y-m-d H:i:s', $data['validTo_time_t']);
				echo($validTo)
				?></td>
				<td><b>validFrom</b></td>
				<td>
				<?php 
				$validFrom = date('Y-m-d H:i:s', $data['validFrom_time_t']);
				//$validTo = date('Y-m-d H:i:s', $data['validTo_time_t']);
				echo($validFrom)
				?></td>
				
				
				</tr>
				<?php
			$i++;
			$entrar=2;
			$linea_concatenada="";
		}
		
		if($entrar==1){
			$linea_concatenada = $linea_concatenada.$line;
			//$certificados[$i]=$line;
			//$i++;
		}
		
        # do same stuff with the $line
    }
	echo("<b>Total: </b>".$i);
	?>
	</tbody>
	</table>
	<table>
			<tr>
			<td><a href="index.php">Volver al Inicio</a></td>
			
			</tr>
			</table>
	<?php
    fclose($file);
	return $certificados;
}
}


readCertificadosFile("certificados/mozilla_certificates.txt");
?>
