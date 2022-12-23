<html>
	<head>
		<title>Digital Certificates</title>
        <script type="text/javascript" src="js/jquery.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styles.css">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script>
    $(document).ready(function() {
		$(".upload").on('click', function() {
        var formData = new FormData();
		var file_ = $('#image');
		var url = $('#t_url').val();
		console.debug(image);
        var files = $('#image')[0].files[0];
		
		//console.debug(claves);
		//console.log(claves.toString())
		//alert(claves);
        formData.append('file',files);
		formData.append('url',url);
		formData.append('accion','cargar');
        $.ajax({
            url: 'upload.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response != 0) {
					$("#resultado").html(response);
                    //$(".card-img-top").attr("src", response);
                } else {
					alert('Formato de imagen incorrecto.');
				}
            }
        });
		return false;
    });
	
	$(".limpiar").on('click', function() {
	document.getElementById('image').value ='';
	document.getElementById('t_url').value ='';
	document.getElementById('resultado').value ='';
	 //$("#resultado").html('');
		var formData = new FormData();
		formData.append('accion','limpiar');
		//console.log("ingrese");
		$.ajax({
            url: 'upload.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response != 0) {
					$("#resultado").html(response);
					
                } else {
					alert('Formato de imagen incorrecto.');
				}
            }
        });
	 
	 });
	
	
});

 //$(document).ready(function() {
 
	
 //});
		
		
		
		
		


        </script>
        <style> 
input[type=text] {
  width: 400px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 100%;
}
.circulo{
background-color: green;
width: 100px;
height: 100px;
}
</style>
	</head>
	<body>
	<div class="container">
    <font face="Comic Sans MS,Arial,Verdana" size=8cm> <p >Digital certificates Trust Verifier</p></font>
	<div class="row">
        <div id="content" class="col-lg-12">
        <form>
            <table action="/verificar2.php" id="form1">
                <!--tr>
                    <td colspan=2> <img src="img/flecha.png" width=400 /></td>
                </tr--->
                <tr>
                    <td><input type="text" id="t_url"></td>
                    <td><input type="button" class="btn btn-primary upload"  value="Subir"></td>
					<td><input type="file" class="form-control-file" name="image" id="image"></td>
					
                </tr>
            </table>
        </form>
		
        <!--span id="resultado"></span>
        <span id="resultado2">0</span-->
		</div>
	</div>
	<div class="row">
	<div id="resultado"> </div>
	</div>
	<div class="row">
		<div id="content" class="col-lg-12">
			<table>
			<tr>
			<td><input type ="button" class="btn btn-primary limpiar" value="Limpiar"/></td>
			</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div id="content" class="col-lg-12">
			<table>
			<tr>
			<td><a href="read_cert.php">Ver Moxilla Trust Store</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td><a href="read_cert2.php">Ver Microsoft Trust Store</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td><a href="read_cert3.php">Ver google Trust Store</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
			</table>
		</div>
	</div>
	</div>
	</body>
</html>