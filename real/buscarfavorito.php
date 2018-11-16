<script>
	function eliminar(id){
    	if (confirm('¿Esta seguro que desea eliminar de Favoritos?')) {
            var datos = "id="+id;

            $.ajax({
              type: "POST",
                  url: "real/quitarfavorito.php",
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

<?php 
	include("../config/conexion.php");

	session_start();
	$user = $_SESSION['id'];
	$queryuser = $conexion->query("SELECT editor,admin FROM usuario WHERE id='$user'");
	$usuario = $queryuser->fetch_assoc();


	$query = "SELECT * FROM manga ORDER BY nombre ASC";

	if (isset($_POST['mangas'])) {
		$manga = mysqli_real_escape_string($conexion, $_POST['mangas']);
		$query = "SELECT * FROM manga WHERE nombre LIKE '%".$manga."%' OR genero LIKE '%".$manga."%' ORDER BY nombre ASC";
	}


	$buscarmangas = $conexion->query($query);

	if (($buscarmangas->num_rows) > 0) {
		?>
		<div class="col-lg-12 box box-footer">
			<div class="box-title">
				<center>
					<h3>Lista de Mangas Favoritos</h3>
				</center>
			</div>			
		<?php		
		while ($row = $buscarmangas->fetch_assoc()) {
			$nombre = $row['nombre'];
            $carpeta = str_replace(" ", "", $nombre);
            $dato = $row['id']."-".$carpeta;

            $id_manga = $row['id'];
            $queryfav = $conexion->query("SELECT * FROM favorito WHERE id_usuario='$user' AND id_manga='$id_manga'");

            if (($queryfav->num_rows) > 0) {
			?>
				<div class="col-lg-3">
					<div class="box box-footer">
						<div class="box-header">
							<div class="box-tools">
					            <button type="button" title="Quitar de Favoritos" class="btn btn-box-tool" onclick="eliminar('<?php echo $id_manga ?>');"><i class="fa fa-remove" style="color: red"></i>
					            </button>
					            <div id="eliminado"></div>
							</div>
						</div>				
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