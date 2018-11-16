<script>
	console.log('Real/Registrar procesando');
</script>
<?php 
	include('../config/conexion.php');

	$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
	$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
	$apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
	$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
	$fecha_na = mysqli_real_escape_string($conexion, $_POST['fecha_nac']);
	$fecha_nac = date_format((new DateTime($fecha_na)), 'Y-m-d');
	$sexo = mysqli_real_escape_string($conexion, $_POST['sexo']);
	$contra = mysqli_real_escape_string($conexion, md5($_POST['contra']));

	$query = $conexion->query("INSERT INTO usuario (usuario,contra,nombre,apellido,sexo,correo,fecha_reg, fecha_nac) VALUES ('$usuario','$contra','$nombre','$apellido','$sexo','$correo',now(),'$fecha_nac')");

	if ($query) {
		?>
        <center><img src="dist/img/loading.gif" id="loadingregister" alt="" width="100" height="100" border="0"></center>		
	    <script type="text/javascript">
	        setTimeout(function(){
	          location.href = 'index.php';
	        },1000);
	    </script>        
		<?php
	}else{
		?>
        <input type="hidden" id="error" value="<?php echo $conexion->error ?>">
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" name="button3" data-dismiss="alert" aria-hidden="true">&times;</button>
          <center>
          	<br>
            <p>Error - No es posible crear cuenta en este momento, intente mas tarde </p>
          </center>
        </div>  
        <script>
        	var error = document.getElementById('error').value;
        	console.log(error);
        </script> 
		<?php
	}
?>
