<script>console.log('Vamos a eliminar')</script>
<?php 
    include("../config/conexion.php");
    
	$id = mysqli_real_escape_string($conexion,$_POST['id']);
	$dirr = mysqli_real_escape_string($conexion,$_POST['dir']);
	$dir = "../".$dirr;


	if (unlink($dir)){
		$query = $conexion->query("DELETE FROM pagina WHERE id='$id'");
		if($query){		
			?>
			<script>
				location.reload(true);
			</script>
			<?php
		}else{
			?>
			<script>console.log('Error al eliminar DB');</script>
			<?php					
		}
	}else{
		?>
		<script>console.log('Error al eliminar');</script>
		<?php		
	}
	
?>
