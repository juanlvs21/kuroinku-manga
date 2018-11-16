<?php 
	include('../config/conexion.php');
	session_start();

	$yo = $_SESSION['id'];

	$opinion = mysqli_real_escape_string($conexion, $_POST['opinion']);
	$puntuacion = mysqli_real_escape_string($conexion, $_POST['puntuacion']);
	$manga = mysqli_real_escape_string($conexion, $_POST['manga']);

	$query = $conexion->query("INSERT INTO opinion (id_usuario,id_manga,opinion,puntuacion,fecha) VALUES ('$yo','$manga','$opinion','$puntuacion',now())");

	if ($query) {
		?>
		<script>location.reload(true);</script>
		<?php
	}else{
		?>
		<input type="hidden" id="error" value="<?php echo $conexion->error ?>">
		<script>
			var error = document.getElementById('error').value;
			console.log(error);
		</script>
		<center> 
			<p style="color:red">Error desconocido, intente más tarde</p>
		</center>
		<?php
	}
?>