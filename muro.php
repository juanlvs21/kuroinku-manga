<?php 
	include("config/conexion.php");
	session_start();
	$yo = $_SESSION['id'];

  	$ultima = $_POST['ultima'];
  	$posicion = 0;

	//Consulta SQL
	$queryultima = $conexion->query("SELECT * FROM publicacion ORDER BY id DESC");

	$contador = 0;
	$publicadopor = "";

	while ($u = $queryultima->fetch_assoc()) {
		if ($u['id'] == $ultima) {
			$posicion = $contador;
			$publicacion = $u['id_usuario'];
		}
		$contador++;
	}

	if ($posicion = 0) {
		
	}
	
	if ($yo != $publicacion) {
		if ($result = 1) {
			echo "Tienes ".$result." publicacion nueva";
		}
		if ($result > 1) {
			echo "Tienes ".$result." publicaciones nuevas";
		}
	}
?>

