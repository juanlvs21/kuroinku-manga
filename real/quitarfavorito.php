<script>console.log('Vamos a añadir a favoritos')</script>
<?php 
    include("../config/conexion.php");
    session_start();
    $user = $_SESSION['id'];
    
	$id = mysqli_real_escape_string($conexion,$_POST['id']);

	$query = $conexion->query("DELETE FROM favorito WHERE id_manga='$id' AND id_usuario='$user'");
	
	if($query){		
		?>
		<script>
			location.reload(true);
		</script>
		<?php
	}else{
		?>
		<script>console.log('Error al quitar de favoritos');</script>
		<?php					
	}
	
?>
