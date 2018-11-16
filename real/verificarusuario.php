<?php 
	include('../config/conexion.php');
	$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);

	if ($usuario != "") {
		$query = $conexion->query("SELECT usuario FROM usuario WHERE usuario='$usuario'");
		$row = $query->fetch_assoc();

		if ($row['usuario'] == $usuario) {
			?>
			<span style="color: red">Nombre de usuario ya existe</span>
			<?php
		}else{
			?>
			<input type="hidden" id="checkuser" value="1">
			<?php
		}
	}

?>
