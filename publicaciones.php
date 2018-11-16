<?php
include 'config/conexion.php';
?>

<?php
  $CantidadMostrar=5;
     // Validado  la variable GET
  $compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
  $queryReg = "SELECT * FROM publicacion";
	$TotalReg = $conexion->query($queryReg);
	$totalr = $TotalReg->num_rows;
	//Se divide la cantidad de registro de la BD con la cantidad a mostrar
	$TotalRegistro  =ceil($totalr/$CantidadMostrar);
	 //Operacion matematica para mostrar los siquientes datos.
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):0;
	//Consulta SQL
	$consultavistas ="SELECT * FROM	publicacion WHERE desactivada='0' ORDER BY id DESC LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
	$consulta = $conexion->query($consultavistas);
  
	while ($lista = $consulta->fetch_assoc()) {
		$userid = mysqli_real_escape_string($conexion,$lista['id_usuario']);
	    $queryusub = "SELECT * FROM usuario WHERE id = '$userid'";
		$usuariob = $conexion->query($queryusub);
	    $use = $usuariob->fetch_assoc();

	    $nombreapellido = $use['nombre']." ".$use['apellido'];
	    $idusersesion = $use['id'];

	    $idp = $lista['id'];
	    $idp_idu = $lista['id']."-".$yo;

    /*$queryfotos = "SELECT * FROM img WHERE publicacion = '$lista[id]'";
    $fotos = $conexion->query($queryfotos);
    $fot = $fotos->fetch_assoc();*/
	?>
  <!-- START PUBLICACIONES -->
    <div class="box box-widget">
      <div class="box-header with-border">
        <div class="user-block">
          <img  src="avatar/<?php echo $use['foto']; ?>" style="clip-path: circle(50% at center);" alt="User Image" height="40" width="auto">
          <?php
          if ($use['verificado'] != 0) { ?>
            <small class="description" onclick="location.href='perfil.php?id=<?php echo $use['id'];?>&perfil=publicacionesp';" style="cursor:pointer; color: red;"><b><?php echo $nombreapellido;?><i class="fa fa-check"></i></b></small>
          <?php
          }else{ ?>
            <small class="description" onclick="location.href='perfil.php?id=<?php echo $use['id'];?>&perfil=publicacionesp';" style="cursor:pointer; color: red;"><b><?php echo $nombreapellido;?></b></small>
          <?php
          }
          if ($use['editor']==1) { ?>
            <small class="description"><i style="color: green;"> Editor<a class="fa fa-pencil" style="  color: green;"></a></i></small>
          <?php
          }
          if ($use['admin']==1) { ?>
            <small class="description"><i style="color: blue;"> Administrador<a class="fa fa-star" style="  color: blue;"></a></i></small>
          <?php
          }
          ?>

          <span class="description"><?php echo $lista['fecha'];?></span>
        </div>
        <!-- /.user-block -->
        <div class="box-tools">
          <script>
            function eliminar(id){
              if (confirm('¿Esta seguro que desea eliminar este tema?')) {
                var datos = 'id='+id;
                $.ajax({
                  type: "POST",
                      url: "real/eliminarpublicacion.php",
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
          if ($userid == $yo) {
            ?>
            <button type="button" title="Eliminar publicación" class="btn btn-box-tool" onclick="eliminar(<?php echo $lista['id'] ?>);"><i class="fa fa-remove"></i>
            </button>
            <div id="eliminado"></div>
            <?php
          }
          ?>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!-- post text -->
        <center><h3><?php echo $lista['titulo'] ?></h3></center>
        <p><?php echo $lista['contenido'];?></p>

        <?php        
        $querync = "SELECT * FROM comentario WHERE id_publicacion = '".$lista['id']."' AND desactivado='0' ";
        $resultnc = $conexion->query($querync);
        $numcomen = $resultnc->num_rows;
        ?>
        <!-- Social sharing buttons -->
        <ul class="list-inline"-->
          <br>
          <li class="pull-right">
            <span href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Respuestas
            (<?php echo $numcomen; ?>)</span>
          </li>
        </ul>
      </div>
      <!-- /.box-body -->
      <div class="box-footer box-comments">
        <center>
          <small><a href="tema.php?id=<?php echo $lista['id'] ?>" style="color: red">Ir al tema</a></small>
        </center>
      </div>
  </div>
  <!-- /.col -->
  <!-- END PUBLICACIONES -->

	<?php
	}

  if (isset($_GET['pag'])) {
    $IncrimentNumante = $_GET['pag'];
    $anteriornav = (($IncrimentNumante)-1);
  }else{
    $IncrimentNumante = 0;
    $anteriornav = (($IncrimentNumante)-1);
  }

  ?>

  <center>
    <p><b><a href="temas.php" style="color: red">Ver todos los temas</a></b></p>
  </center>

