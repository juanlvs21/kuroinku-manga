<?php
if ($row['id']==$rowget['id']) {
?>
  <div class="box-footer">
            <div class="box-header">
              <h3 class="box-title">Crear tema</h3>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="input-group">
                <input type="text" id="titulo" name="titulo" placeholder="Titulo..." class="form-control">
                <textarea name="publicacion" onkeypress="return validarn(event)" id="publicacion" placeholder="Descripción del tema" class="form-control" cols="200" rows="3" required></textarea>
                
                <select class="form-control" required id="temacategoria" name="temacategoria">
                  <option value="">Eliga una categoria...</option>
                  <option value="1">Consulta</option>
                  <option value="2">Opiníon</option>
                  <option value="3">Recomendación</option>
                </select>

                <!-- START Input file nuevo diseño .--> 
                <!--label for="archivo" class="btn btn-danger btn-flat btn-sm">Subir una foto</label-->             
                <input type="file" name="archivo" id="archivo">
                <!-- END Input file nuevo diseño .-->  
                <br>
                <button type="submit" name="publicar"  id="publicar" class="btn btn-danger btn-flat">Crear</button>
              </div>
            </form>

            <?php
            if(isset($_POST['publicar'])){
              $publicacion = mysqli_real_escape_string($conexion,$_POST['publicacion']);
              $categoria = mysqli_real_escape_string($conexion,$_POST['temacategoria']);
              $titulo = mysqli_real_escape_string($conexion,$_POST['titulo']);
              /*$ruta = 'publicaciones/';
              $destino = basename($_FILES['archivo']['name']);*/

              $queryr = "SHOW TABLE STATUS WHERE `Name` = 'publicaciones'";
              $result = $conexion->query($queryr);
              $data = $result->fetch_assoc();
              $next_increment = $data['Auto_increment'];

              $userpublic = $_SESSION['id'];
              $fechanombreimg = date('Y-m-d');
              $alea = $userpublic."-".$fechanombreimg."-".substr(strtoupper(md5(microtime(true))), 0,12);
              $code = $next_increment.$alea;

              $type = 'jpg';
              $rfoto = $_FILES['archivo']['tmp_name'];
              $name = $code.".".$type;

              if(is_uploaded_file($rfoto)){

                $img_destino = "publicaciones/".$name;
                $img_nombre = $name;
                copy($rfoto, $img_destino);

                $subir_query = "INSERT INTO publicacion (id_usuario,fecha,contenido,img, categoria, titulo) values ('".$_SESSION['id']."',now(),'$publicacion','$img_nombre','$categoria', '$titulo')";
                $subir_result = $conexion->query($subir_query);
                if ($subir_result) {
                }else{
                    ?>
                  <script>alert('Al subir la publicacion');</script>
                  <?php
                }               

              }else{              
                $subir_query = "INSERT INTO publicacion (id_usuario,fecha,contenido, categoria, titulo) values ('".$_SESSION['id']."',now(),'$publicacion','$categoria', '$titulo')";
                $subir_result = $conexion->query($subir_query);
                if ($subir_result) {
                }else{
                    ?>
                  <script>alert('Al subir la publicacion');</script>
                  <?php
                }   
              }
            }
            ?>

    <?php
    if(isset($_POST['publicar'])){
      $publicacion = mysqli_real_escape_string($conexion,$_POST['publicacion']);
      /*$ruta = 'publicaciones/';
      $destino = basename($_FILES['archivo']['name']);*/

      $queryr = "SHOW TABLE STATUS WHERE `Name` = 'publicaciones'";
      $result = $conexion->query($queryr);
      $data = $result->fetch_assoc();
      $next_increment = $data['Auto_increment'];

      $userpublic = $_SESSION['id']."-";
      $alea = $userpublic.substr(strtoupper(md5(microtime(true))), 0,12);
      $code = $next_increment.$alea;

      $type = 'jpg';
      $rfoto = $_FILES['archivo']['tmp_name'];
      $name = $code.".".$type;

      if(is_uploaded_file($rfoto)){

        $img_destino = "publicaciones/".$name;
        $img_nombre = $name;
        copy($rfoto, $img_destino);

        $subir_query = "INSERT INTO publicacion (id_usuario,fecha,contenido,img) values ('".$_SESSION['id']."',now(),'$publicacion','$img_nombre')";
        $subir_result = $conexion->query($subir_query);
        if ($subir_result) {
        }else{
            ?>
          <script>alert('Al subir la publicacion');</script>
          <?php
        }               

      }else{              
        $subir_query = "INSERT INTO publicacion (id_usuario,fecha,contenido) values ('".$_SESSION['id']."',now(),'$publicacion')";
        $subir_result = $conexion->query($subir_query);
        if ($subir_result) {
        }else{
            ?>
          <script>alert('Al subir la publicacion');</script>
          <?php
        }   
      }
    }
  ?>
</div>
<?php
}
?>

<?php
include 'config/conexion.php';

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
  //$idusu = $row['id'];
	$consultavistas ="SELECT * FROM	publicacion WHERE id_usuario='$id' AND desactivada='0' ORDER BY id DESC LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
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
          <!-- Box Comment -->
          <div class="box box-default"> <!-- box-widget coloca todo blanco box-default coloca las lineas grises-->
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="avatar/<?php echo $use['foto']; ?>" alt="User Image">
                <?php
                if ($rowget['verificado'] != 0) { ?>
                  <span class="description" onclick="location.href='perfil.php?id=<?php echo $rowget['id']."&perfil=publicacionesp";?>';" style="cursor:pointer; color: red;"><?php echo $use['nombre']." ".$use['apellido']." ";?><i class="fa fa-check"></i></span>
                <?php
                }else{ ?>
                  <span class="description" onclick="location.href='perfil.php?id=<?php echo $rowget['id'];?>';" style="cursor:pointer; color:red;"><?php echo $use['nombre']." ".$use['apellido'];?></span>
                <?php
                }
                ?>
                <span class="description"><?php echo $lista['fecha'];?></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
              <script>
                function eliminar(id){
                  if (confirm('¿Esta seguro que desea eliminar esta publicación?')) {
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
                <button type="button" class="btn btn-box-tool" title="Eliminar publicación" onclick="eliminar(<?php echo $lista['id'] ?>);"><i class="fa fa-remove"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->
              <p validarn(e)><?php echo $lista['contenido'];?></p>

              <?php
              if($lista['img'] != 0){
                $file = "publicaciones/".$lista['img'];  // Dirección de la imagen
               
                $imagen = getimagesize($file);    //Sacamos la información
                $ancho = $imagen[0];              //Ancho
                $alto = $imagen[1];               //Alto
            
                if ($ancho > $alto) {
                  ?>
                      <center>
                        <a data-lightbox="roadtrip" data-title="<a href='perfil.php?id=<?php echo $idusersesion;?>&perfil=publicacionesp' style='color: red;'><?php echo $nombreapellido;?></a> | <?php echo $lista['fecha'] ?> <br> <?php echo $lista['contenido'] ?>" href="publicaciones/<?php echo $lista['img'];?>">
                        <img class="img-responsive" src="publicaciones/<?php echo $lista['img'];?>" height="auto" width="500px">
                        </a> 
                      </center> 
                  <?php
                }
                if ($alto > $ancho) {
                      ?> 
                      <center>
                        <a data-lightbox="roadtrip" data-title="<a href='perfil.php?id=<?php echo $idusersesion;?>&perfil=publicacionesp' style='color: red;'><?php echo $nombreapellido;?></a> | <?php echo $lista['fecha'] ?> <br> <?php echo $lista['contenido'] ?>" href="publicaciones/<?php echo $lista['img'];?>">
                        <img class="img-responsive" src="publicaciones/<?php echo $lista['img'];?>" height="300px" width="auto">
                        </a> 
                      </center>            
                      <?php
                }
              }
              ?>

              <br><br>
              <?php
              $querync = "SELECT * FROM comentario WHERE id_publicacion = '".$lista['id']."' AND desactivado='0'";
              $resultnc = $conexion->query($querync);
              $numcomen = $resultnc->num_rows;
              ?>
              <!-- Social sharing buttons -->
              <ul class="list-inline">

                <li class="pull-right">
                  <span href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Respuestas
                  (<?php echo $numcomen; ?>)</span>
                </li>
              </ul>
            </div>




      <div class="box-footer box-comments">
        <center>
          <small><a href="tema.php" style="color: red">Ir al tema</a></small>
        </center>
      </div>
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
    <br>
    <p><b><a href="temas.php" style="color: red">Ver todos los temas</a></b></p>
  </center>

