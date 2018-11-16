<?php 
	include('../config/conexion.php');
	$correo = mysqli_real_escape_string($conexion, $_POST['correo']);

	if ($correo != "") {
		$query = $conexion->query("SELECT correo FROM usuario WHERE correo='$correo'");
		$row = $query->fetch_assoc();

		if ($row['correo'] == $correo) {
			?>
			<span style="color: red">Correo electronico ya esta registrado</span>
			<?php
		}else{
			?>
			<input type="hidden" id="checkcorreo" value="1">
			<?php
		}
	}

?>
