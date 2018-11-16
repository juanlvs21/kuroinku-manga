<?php 
    include("../config/conexion.php");
    
	$id = $_POST['id'];

	$query = $conexion->query("UPDATE comentario SET desactivado='1' WHERE id='$id'");

	if($query){
		?>
		<script>console.log('Comentario eliminado');</script>
		<?php
	}else{
		?>
		<script>console.log('Error al eliminar comentario');</script>
		<?php		
	}
	
?>