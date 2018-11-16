<script>console.log('Vamos a añadir a favoritos')</script>
<?php 
    include("../config/conexion.php");
    session_start();
    $user = $_SESSION['id'];
    
	$id = mysqli_real_escape_string($conexion,$_POST['id']);

	$query = $conexion->query("INSERT INTO favorito (id_usuario,id_manga) VALUES ('$user','$id') ");
	
	if($query){		
		?>
		<script>
			location.reload(true);
		</script>
		<?php
	}else{
		?>
		<script>console.log('Error al añadir a favoritos');</script>
		<?php					
	}
	
?>
