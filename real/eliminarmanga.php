<script>console.log('Vamos a eliminar')</script>
<?php 
    include("../config/conexion.php");
    
	$manga = mysqli_real_escape_string($conexion,$_POST['id']);
	$dirr = mysqli_real_escape_string($conexion,$_POST['dir']);
	$dir = "../mangas/".$dirr;

	$querycap = $conexion->query("SELECT cap FROM capitulo WHERE id_manga='$manga'");

	// ELIMINA LAS PAGINAS DE LOS CAPITULOS Y SUS CARPETAS
	while ($cap = $querycap->fetch_assoc()) {
		$dircap = $dir."/".$cap['cap'];
		if (is_dir($dircap)) {
			$files = glob($dircap.'/*'); // obtiene todos los archivos
			foreach($files as $file){
			  if(is_file($file)) // si se trata de un archivo
			    unlink($file); // lo elimina
			}
		}
		rmdir($dircap);
	}

	// ELIMINA LA PORTADA Y EL MANGA
	if (is_dir($dir)) {
		$files = glob($dir.'/*'); // obtiene todos los archivos
		foreach($files as $file){
		  if(is_file($file)) // si se trata de un archivo
		    unlink($file); // lo elimina
		}
		if (rmdir($dir)){
			$query = $conexion->query("DELETE FROM manga WHERE id='$manga'");
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

