<?php
	include 'read_file.php';
	$direccion = $_REQUEST['url'];
	$url = preg_replace( "!https?://!i", "", filter_var( $direccion, FILTER_SANITIZE_URL ) );
	$parsedUrl = parse_url ( "https://" . $url );
	$port = array_key_exists( 'port', $parsedUrl ) ? $parsedUrl['port'] : "443";
	$host = $parsedUrl['host'];
	//echo($host);
	//echo($port);
	//if ( is_array( getCertificateInfo( $host, $port ) ) ) {
		//echo("entre aqui");

		$certificateInfo = getCertificateInfo( $host, $port );
		echo("<pre>");
		print_r($certificateInfo);
		echo("</pre>");
		?>
		<table border=1>
		<tr> <td>Subject</td>
		<td>
		<?php
		echo($certificateInfo['subject'] ['CN']);
		?>
		</td>
		</tr>
		<tr> <td>Name</td><td>
		<?php
		echo($certificateInfo['name']);
		?>
		</td>
		</tr>
		</tr>
		<tr> <td>issuer</td><td>
		<?php
		echo($certificateInfo['issuer']['C']);
		
		?>
		<br>
		<?php
		echo($certificateInfo['issuer']['O']);
		?>
		<br>
		<?php
		echo($certificateInfo['issuer']['CN']);
		?>
		</td>
		</tr>
		<tr> <td>Periodo de validez</td><td>
		<?php
		$from = date('Y-m-d H:i:s', $certificateInfo['validFrom_time_t']);
		echo($from);
		echo(" - ");
		$to = date('Y-m-d H:i:s', $certificateInfo['validTo_time_t']);
		echo($to);
		echo(" = ");
		echo($to - $from);
		?>
		</td>
		</tr>
		<tr> <td>Constrainst</td><td>
		<?php
		echo($certificateInfo['extensions']['basicConstraints']);
		
		?>
		</td>
		</tr>
		<tr> <td>Public Key</td><td>
		<?php
		echo("<pre>");
		print_r($certificateInfo['subject-public-key-info']['rsa']);
		echo("</pre>");
		?>
		</td>
		</tr>
		<tr> <td>Certificate: </td><td>
		<?php
		echo("<pre>");
		print_r($certificateInfo['x-certificate']);
		echo("</pre>");
		?>
		</td>
		</tr>
		</table>
		