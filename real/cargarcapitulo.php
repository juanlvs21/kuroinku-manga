<script>
	function eliminar(datos){
    	if (confirm('¿Esta seguro que desea eliminar este capitulo?')) {
            var recibe = datos.split("-");
            var manga = recibe[0];
            var cap = recibe[1];
            var dir = recibe[2];

            var datos = "manga="+manga;
            datos += "&cap="+cap;
            datos += "&dir="+dir;

            $.ajax({
              type: "POST",
                  url: "real/eliminarcapitulo.php",
                  data: datos,
                  dataType:"html",
                  asycn:false,
            })
            .done(function(respuesta2){
              $("#eliminado").html(respuesta2);
            })
            .fail(function(respuesta2){
              console.log('error');
            })  
        }
 	}
  </script>

<script>
	function capitulo(cap){
		var cap_m = cap.split("-");
		var manga = cap_m[0];
		var cap = cap_m[1];

		location.href= "capitulo.php?manga="+manga+"&cap="+cap;
	}
</script>

<?php 
	$user = $_SESSION['id'];
	$queryuser = ($conexion->query("SELECT admin,editor FROM usuario WHERE id='$user'"))->fetch_assoc();

	$query = "SELECT * FROM capitulo WHERE id_manga='$idmanga'";
	$capitulo = $conexion->query($query);

	$manga = ($conexion->query("SELECT id,nombre FROM manga WHERE id='$idmanga'"))->fetch_assoc();

	if (($capitulo->num_rows) > 0) {
		?>
		<div class="box box-footer">
			<table class="table">
				<tr>
                 	<th><center>Capitulo</center></th>
                 	<th><center>Nombre</center></th>
                 	<th><center>Fecha publicion</center></th>
                 	<?php 
                 	if (($queryuser['admin'] == 1) || ($queryuser['editor'] == 1)) {
                 		?>
						<th><center>Publicado</center></th>
						<th><center>Eliminar</center></th>
                 		<?php
                 	}
                  	?>
                </tr>
			<?php
			while ($row = $capitulo->fetch_assoc()) {
				$cap_m = $manga['id']."-".$row['cap'];
				$nomb = str_replace(" ", "", $manga['nombre']);
				$mang_cap = $manga['id']."-".$row['cap']."-".$nomb;
				if (($queryuser['admin'] == 1) || ($queryuser['editor'] == 1)) {
					?>
					<tr>
						<ul>
			            	<td>
			            		<center>
			            			<?php echo $row['cap'] ?>
			            		</center>
			            	</td>
			            	<td>
			            		<center>
			                	<a style="cursor:pointer; color:red" onclick="capitulo('<?php echo $cap_m ?>')">	<?php echo $row['nombre'];?></a>
			                	</center>
			            	</td>	            	
			            	<td>
			            		<center>
			            			<?php echo $row['fecha_sub'] ?>
			            		</center>
			            	</td>
			            	<?php 
			            	if (($queryuser['admin'] == 1) || ($queryuser['editor'] == 1)) {
			            		if ($row['publicado'] == 1) {
				            		?>
					            	<td><center> Si </center></td>
				            		<?php
			            		}else{
				            		?>
					            	<td><center> No </center></td>
				            		<?php		            			
			            		}
			            		?>
				            	<td><center><button type="button" title="Eliminar capitulo" class="btn btn-danger btn-sm" onclick="eliminar('<?php echo $mang_cap ?>');"><i class="fa fa-remove" style="color: black"></i>
					            </button><div id="eliminado"></div></center></td>
			            		<?php				            		
			            	}
			            	?>
						</ul>
					</tr>
					<?php
				}else{
					if ($row['publicado'] == 1) {
						?>
						<tr>
							<ul>
				            	<td>
				            		<center>
				            			<?php echo $row['cap'] ?>
				            		</center>
				            	</td>
				            	<td>
				            		<center>
				                	<a style="cursor:pointer; color:red" onclick="capitulo('<?php echo $cap_m ?>')">	<?php echo $row['nombre'];?></a>
				                	</center>
				            	</td>	            	
				            	<td>
				            		<center>
				            			<?php echo $row['fecha_sub'] ?>
				            		</center>
				            	</td>
				            	<?php 
				            	if (($queryuser['admin'] == 1) || ($queryuser['editor'] == 1)) {
				            		if ($row['publicado'] == 1) {
					            		?>
						            	<td><center> Si </center></td>
					            		<?php
				            		}else{
					            		?>
						            	<td><center> No </center></td>
					            		<?php		            			
				            		}
				            	}
				            	?>
							</ul>
						</tr>
						<?php
					}
				}
			}
			?>
			</table>
		</div>
		<?php
	}else{		
		?>
		<center>
			<div class="box box-title">			
				<div class="box box-footer">
					<p>No hay capitulos</p>
				</div>
			</div>
		</center>
		<?php
	}

?>
