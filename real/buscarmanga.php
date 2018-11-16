<script>
	function eliminar(datos){
    	if (confirm('¿Esta seguro que desea eliminar este Manga?')) {
            var recibe = datos.split("-");
            var id = recibe[0];
            var dir = recibe[1];

            var datos = "id="+id;
            datos += "&dir="+dir;

            $.ajax({
              type: "POST",
                  url: "real/eliminarmanga.php",
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

	function favorito(id){
        var datos = "id="+id;

        $.ajax({
          type: "POST",
              url: "real/agregarfavorito.php",
              data: datos,
              dataType:"html",
              asycn:false,
        })
        .done(function(respuesta2){
          $("#fav").html(respuesta2);
        })
        .fail(function(respuesta2){
          console.log('error');
        })  
 	}
</script>

<?php 
	include("../config/conexion.php");

	session_start();
	$user = $_SESSION['id'];
	$queryuser = $conexion->query("SELECT editor,admin FROM usuario WHERE id='$user'");
	$usuario = $queryuser->fetch_assoc();


	$query = "SELECT * FROM manga  WHERE publicado='1' ORDER BY nombre ASC";
	$query2 = "SELECT * FROM manga WHERE publicado='0' ORDER BY nombre ASC";

	if (isset($_POST['mangas'])) {
		$manga = mysqli_real_escape_string($conexion, $_POST['mangas']);
		$query = "SELECT * FROM manga WHERE (nombre LIKE '%".$manga."%' OR genero LIKE '%".$manga."%') AND publicado='1' ORDER BY nombre ASC";
		$query2 = "SELECT * FROM manga WHERE (nombre LIKE '%".$manga."%' OR genero LIKE '%".$manga."%') AND publicado='0' ORDER BY nombre ASC";
	}


	$buscarmangas = $conexion->query($query);
	$buscarmangas2 = $conexion->query($query2);

	if (($buscarmangas2->num_rows) > 0) {
		if (($usuario['editor'] == 1) || ($usuario['admin'] == 1)) {
			?>
			<div class="col-lg-12 box box-footer">
				<div class="box-title">
					<center>
						<h3>Mangas no Publicados</h3>
					</center>
				</div>
				<?php
				while ($row2 = $buscarmangas2->fetch_assoc()) {
					$nombre = $row2['nombre'];
                    $carpeta = str_replace(" ", "", $nombre);
                    $dato = $row2['id']."-".$carpeta;
                    $idm = $row2['id'];

                    $queryfav = $conexion->query("SELECT * FROM favorito WHERE id_usuario = '$user' AND id_manga = '$idm'");
					?>
					<div class="col-lg-3">
						<div class="box box-footer">
							<div class="box-header">
								<div class="box-tools">
									<?php 
									if (($queryfav->num_rows) > 0) {
										?>
							            <button type="button" title="Añadir a favoritos" class="btn btn-box-tool" onclick="favorito('<?php echo $idm ?>');"><i class="fa fa-star text-yellow"></i>
							            </button>
										<?php
									}else{
										?>
							            <button type="button" title="Añadir a favoritos" class="btn btn-box-tool" onclick="favorito('<?php echo $idm ?>');"><i class="fa fa-star text-white"></i>
							            </button>
										<?php										
									}
									?>
						            <button type="button" title="Eliminar Manga" class="btn btn-box-tool" onclick="eliminar('<?php echo $dato ?>');"><i class="fa fa-remove" style="color: red"></i>
						            </button>
						            <div id="eliminado"></div>
						            <div id="fav"></div>
								</div>
							</div>							
							<center>
				            	<h4 class="box-title" style="cursor:pointer" onclick="location.href='manga.php?id=<?php echo $row2['id'];?>';">
				                	<?php echo $row2['nombre'];  ?>
				            	</h4>	
				                <img src="mangas/<?php echo $carpeta ?>/portada.jpg" alt="" width="100" height="100">
				            </center>	
				            <br>
						</div>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
	}else{
		if (($usuario['editor'] == 1) || ($usuario['admin'] == 1)) {		
			?>
			<center>
				<div class="col-lg-12 box box-title">
					<div class="">
							<h3>Lista de Mangas</h3>
					</div>				
					<div class="box box-footer">
						<p>No se han encontrado Mangas relacionados</p>
					</div>
				</div>
			</center>
			<?php
		}
	}

	if (($buscarmangas->num_rows) > 0) {
		?>
		<div class="col-lg-12 box box-footer">
			<div class="box-title">
				<center>
					<h3>Lista de Mangas</h3>
				</center>
			</div>			
		<?php		
		while ($row = $buscarmangas->fetch_assoc()) {
			$nombre = $row['nombre'];
            $carpeta = str_replace(" ", "", $nombre);
            $dato = $row['id']."-".$carpeta;
            $idm = $row['id'];
            $queryfav = $conexion->query("SELECT * FROM favorito WHERE id_usuario = '$user' AND id_manga = '$idm'");            
			?>
			<div class="col-lg-3">
				<div class="box box-footer">
					<?php 
					if (($usuario['editor'] == 1) || ($usuario['admin'] == 1)) {
					?>
						<div class="box-header">
							<div class="box-tools">
								<?php 
								if (($queryfav->num_rows) > 0) {
									?>
						            <button type="button" title="Añadir a favoritos" class="btn btn-box-tool" onclick="favorito('<?php echo $idm ?>');"><i class="fa fa-star text-yellow"></i>
						            </button>
									<?php
								}else{
									?>
						            <button type="button" title="Añadir a favoritos" class="btn btn-box-tool" onclick="favorito('<?php echo $idm ?>');"><i class="fa fa-star text-white"></i>
						            </button>
									<?php										
								}
								?>
					            <button type="button" title="Eliminar publicación" class="btn btn-box-tool" onclick="eliminar('<?php echo $dato ?>');"><i class="fa fa-remove" style="color: red"></i>
					            </button>
					            <div id="eliminado"></div>
					            <div id="fav"></div>
							</div>
						</div>	
					<?php 
					}
					?>					
					<center>
		            	<h4 class="box-title"  style="cursor:pointer" onclick="location.href='manga.php?id=<?php echo $row['id'];?>';">
		                	<?php echo $row['nombre'];  ?>
		            	</h4>	
		                <img src="mangas/<?php echo $carpeta ?>/portada.jpg" alt="" width="100" height="100">
		            </center>	
		            <br>
				</div>
			</div>
			<?php
		}
		?>
		</div>
		<?php		
	}else{
		?>
		<center>
			<div class="col-lg-12 box box-title">
				<div class="">
						<h3>Lista de Mangas</h3>
				</div>				
				<div class="box box-footer">
					<p>No se han encontrado Mangas relacionados</p>
				</div>
			</div>
		</center>
		<?php
	}

?>