<?php
//Firefox
include 'get_cer_url.php';
function readCertificados($name_file, $certificado_url){
$certificados = array();

$i=0;
$entrar=2;
$linea_concatenada="";
if($file = fopen($name_file, "r")) {
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
			/*if($certificado_url == $linea_concatenada){
				echo("Si extiste");
			}
			*/
			$certificados[$i]=$linea_concatenada;
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
    fclose($file);
	return $certificados;
}
};



//echo("url-----<br>");


//$url="https://www.google.com";
//is_ssl_exists($url);
/* Conseguimos el url*/
function validarCertificados($q){
$output = "";
//if ( isset( $_REQUEST['q'] ) && ( trim( $_REQUEST['q'] ) != "" ) ) {
	

	$url = preg_replace( "!https?://!i", "", filter_var( $q, FILTER_SANITIZE_URL ) );
	$parsedUrl = parse_url ( "https://" . $url );
	$port = array_key_exists( 'port', $parsedUrl ) ? $parsedUrl['port'] : "443";
	$host = $parsedUrl['host'];
	
	

	if ( is_array( getCertificateInfo( $host, $port ) ) ) {
		//echo("entre aqui");

		$certificateInfo = getCertificateInfo( $host, $port );
		/*echo("<pre>");
		print_r($certificateInfo);
		echo("</pre>");*/
		
		$fingerPrints = $certificateInfo['x-fingerprints'];
		$ts = date( "r", $certificateInfo['x-retrieval-time']['unix'] );
		

		$certificado_url = $certificateInfo['x-certificate'] ['base64'];
		$certificado_url2 = $certificateInfo['x-certificate'] ['hex'];
		/*echo("<pre>");
		print_r ($certificateInfo);
		echo("</pre>");
		echo("<pre>");
		print_r ($certificateInfo['subject-public-key-info']);
		echo("</pre>");
		echo($certificado_url);
		echo("<br>");
		echo("---");
		echo($certificado_url2);
		*/
		$certificados_firefox =readCertificados("certificados/chrome_certificates.txt", $certificado_url);
		
		return 2;
		/*echo("<pre>");
		print_r($certificados_firefox);
		echo("</pre>");*/


	} else {

		// error
		$output = getCertificateInfo( $host, $port );

	}

	$q = $host . ( ( $port != 443 ) ? ":$port" : "" );
}
//}


?>