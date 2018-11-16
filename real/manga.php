<script>
	function eliminar(datos){
    	if (confirm('¿Esta seguro que desea eliminar esta página?')) {
            var recibe = datos.split("*");
            var id = recibe[0];
            var dir = recibe[1];

            var datos = "id="+id;
            datos += "&dir="+dir;

            $.ajax({
              type: "POST",
                  url: "real/eliminarpagina.php",
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
    $usuario =  $_SESSION['usuario'];
    $query = "SELECT * FROM usuario WHERE usuario='$usuario'";
    $result = $conexion->query($query);
    $usere = $result->fetch_assoc();

	$query = "SELECT cap,img,id FROM pagina WHERE id_manga='$idmanga' AND cap='$idcap' ORDER BY pag ASC";
	$capitulo = $conexion->query($query);

	$nombremanga = ($conexion->query("SELECT nombre FROM manga WHERE id='$idmanga'"))->fetch_assoc();

	?>
	<div class="box box-footer">
		<?php
		while ($row = $capitulo->fetch_assoc()) {
			$nombre = $nombremanga['nombre'];
            $nombre2 = str_replace(" ", "", $nombre);
            $carpeta = $nombre2."/".$idcap;
            $nomb = $row['img'];
			?>
			<div class="">
				<?php 
				if (($usere['admin'] == 1) || ($usere['editor'] == 1) ){
					$id = $row['id'];
					$dir = "mangas/".$carpeta."/".$nomb;
					$dato = $id.'*'.$dir;
					?>							
					<div class="box-header">
						<div class="box-tools">
					            <button type="button" title="Eliminar Pagina" class="btn btn-box-tool" onclick="eliminar('<?php echo $dato ?>');"><i class="fa fa-remove"></i>
					            </button>
					            <div id="eliminado"></div>
					         
						</div>
						<br>
					</div>
   				<?php
				}
				?>					
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