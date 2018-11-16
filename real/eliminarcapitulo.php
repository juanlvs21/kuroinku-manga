<script>console.log('Vamos a eliminar')</script>
<?php 
    include("../config/conexion.php");
    
	$manga = mysqli_real_escape_string($conexion,$_POST['manga']);
	$cap = mysqli_real_escape_string($conexion,$_POST['cap']);
	$dirr = mysqli_real_escape_string($conexion,$_POST['dir']);
	$dir = "../mangas/".$dirr."/".$cap;

	if (is_dir($dir)) {
//---------------------	
		$files = glob($dir.'/*'); // obtiene todos los archivos
		foreach($files as $file){
		  if(is_file($file)) // si se trata de un archivo
		    unlink($file); // lo elimina
		}
//---------------------		
		if (rmdir($dir)){
			$query = $conexion->query("DELETE FROM capitulo WHERE cap='$cap' AND id_manga='$manga'");
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
	}else{
		?>
		<script>console.log('La carpeta del capitulo no existe');</script>
		<?php				
	}
?>

