<?php 
    include("../config/conexion.php");
    
	$id = $_POST['id'];

	$query = $conexion->query("UPDATE publicacion SET desactivada='1' WHERE id='$id'");

	if($query){
		?>
		<script>
			location.reload(true);
		</script>
		<?php
	}else{
		?>
		<script>console.log('Error al eliminar');</script>
		<?php		
	}
	
?>