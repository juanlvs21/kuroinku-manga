<?php 
	$idmanga = mysqli_real_escape_string($conexion, $_GET['id']);

	$query = "SELECT img FROM pagina WHERE id_manga='$idmanga' ORDER BY pag ASC";
	$manga = $conexion->query($query);

	$nombremanga = ($conexion->query("SELECT nombre FROM manga WHERE id='$idmanga'"))->fetch_assoc();

	?>
	<div class="box box-footer">
		<?php
		while ($row = $manga->fetch_assoc()) {
			$nombre = $nombremanga['nombre'];
            $carpeta = str_replace(" ", "", $nombre);
			?>
			<div class="">
				<div class="box box-footer">
					<center>
		                <img src="mangas/<?php echo $carpeta ?>/<?php echo $row['img'] ?>" class="img-responsive" height="" >
		            </center>	
		            <br>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<?php

?>