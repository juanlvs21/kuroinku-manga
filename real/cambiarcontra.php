<?php 
	include("../config/conexion.php");
	session_start();

	$actual = mysqli_real_escape_string($conexion, md5($_POST['contraactual']));
	$nuevacontra = mysqli_real_escape_string($conexion, md5($_POST['nuevacontra']));
	$repetircontra = mysqli_real_escape_string($conexion, md5($_POST['repetircontra']));
	$user = $_SESSION['id'];

	$queryverificar = ($conexion->query("SELECT contra FROM usuario WHERE id='$user'"))->fetch_assoc();

	if ($actual != $queryverificar['contra']) {
		?>
		<br>
		<center><small class="alert alert-danger" style="color: red">Contraseñas no coinciden</small></center>
		<?php
	}else{
		$querycambiar = $conexion->query("UPDATE usuario SET contra='$nuevacontra' WHERE id='$user'");
		if ($querycambiar) {
			?>
			<script>
				console.log('Contraseña cambiada con exito');
				$('#modalcontra').modal('hide'); //cerrar modal
			</script>
			<?php
		}else{
			?>
			<br>
			<center><small class="alert alert-danger" style="color: red">Error desconocido - Intente más tarde</small></center>
			<?php
		}
	}
?>