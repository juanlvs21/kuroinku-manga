<?php
  include 'config/conexion.php';

  $CantidadMostrar=5;
     // Validado  la variable GET
  $compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
  $queryReg = "SELECT * FROM noticia";
	$TotalReg = $conexion->query($queryReg);
	$totalr = $TotalReg->num_rows;
	//Se divide la cantidad de registro de la BD con la cantidad a mostrar
	$TotalRegistro  =ceil($totalr/$CantidadMostrar);
	 //Operacion matematica para mostrar los siquientes datos.
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):0;
	//Consulta SQL
	$consultavistas ="SELECT * FROM	noticia WHERE tipo='1' ORDER BY id DESC LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
	$consulta = $conexion->query($consultavistas);
  ?>
  <div class="box box-footer">
    <div class="box-header">
      <center><h3>Noticias de <b>Kuroinku</b></h3></center>
    </div>
    <?php
    if ($row['admin'] == 1) { ?>
      <div class="box-body">
        <center>
            <button class="btn btn-danger" data-toggle="modal" data-target="#modalpublicarnoticia" type="button" name="btnpublicarnoticia">Publicar Noticia</button>
        </center>
      </div>
    <?php
    }
    ?>
  </div>
  <!--MODAL PUBLICAR NOT NOTICIA -->
  <div class="modal fade" id="modalpublicarnoticia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <!-- si quitas data-dismiss="modal" no se cierra el modal con un alert-->
            <center>
              <h3 style="color:black;">Publicar Noticia<small> Kuroinku</small></h3>
            </center>
          </div>
          <div class="modal-body"><!--#Body modal comentar-->
            <form class="form-group has-feedback" method="post">
              <input class="form-control" type="text" name="titulon" value="" placeholder="Titulo" required>
              <br>
              <input class="form-control" type="text" name="prevn" value="" placeholder="Introducción" required>
              <br>
              <textarea class="form-control" type="text" name="notician" value="" placeholder="Noticia" required></textarea>
              <br>
              <center><button class="btn btn-success" type="submit" name="btnpublicarn">Publicar</button></center>
            </form>
            <?php
            if (isset($_POST['btnpublicarn'])) {
              $titulon = mysqli_real_escape_string($conexion,$_POST['titulon']);
              $prevn = mysqli_real_escape_string($conexion,$_POST['prevn']);
              $notician = mysqli_real_escape_string($conexion,$_POST['notician']);

              $querypublicarn = "INSERT INTO noticia (titulo,fecha,prev,noticia,tipo,id_usuario) VALUES ('$titulon',now(),'$prevn','$notician',1,'$yo')";
              $resultpublicarn = $conexion->query($querypublicarn);

              if ($resultpublicarn) { ?>
                <script type="text/javascript">
                  location.href = 'noticias.php?noticia=nkuroinku';
                </script>
              <?php
              }
            }
            ?>

          </div><!--/#Body modal editar datos-->
          <div class="modal-footer">
            <button type="button" name="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
          </div>

        </div>
    </div>
  </div>
  <!-- FIN MODAL PUBLICAR NOTICIA -->
  <?php
	while ($lista = $consulta->fetch_assoc()) { ?>
    <div class="box box-profile">
      <div class="box-header with-border">
        <div class="">
          <center>
            <span class="username"><h4 style="color: red;"><?php echo $lista['titulo'];?></h4></span>
            <span class="username"><?php echo $lista['fecha'];?></span>
          </center>
        </div>
        <!-- /.user-block -->
        <div class="box-tools">
          <button type="button" class="btn btn-box-tored" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!-- post text -->
        <p><?php echo $lista['noticia'];?></p>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <?php
        $redactado = $lista['id_usuario'];
        $queryredactado = "SELECT nombre,apellido FROM usuario WHERE id='$redactado'";
        $resultredactado = $conexion->query($queryredactado);
        $rowredactado = $resultredactado->fetch_assoc();

        ?>
        <span class="description" onclick="location.href='perfil.php?id=<?php echo $lista['id_usuario'];?>&perfil=publicacionesp';" style="cursor:pointer; color: black;">Redactado por: <a style="color:red;"><?php echo $rowredactado['nombre']." ".$rowredactado['apellido'];?></a></span>
      </div>
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
    <nav>
        <ul class="pagination">
          <?php
          if ($anteriornav == -1) { ?>
            <li class="disabled"><a class="disabled"><i class="glyphicon glyphicon-chevron-left"></i> Anterior</a></li>
          <?php
          } else{ ?>
            <li><a href="noticias.php?pag=<?php echo $anteriornav ?>&noticia=nkuroinku"><i class="glyphicon glyphicon-chevron-left"></i> Anterior</a></li>
          <?php
          }?>
          <li><a href="noticias.php?noticia=nkuroinku"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
          <?php
            if ($IncrimentNum == 0) { ?>
              <li class="disabled"><a class="disable">Siguiente <i class="glyphicon glyphicon-chevron-right"></i></a></li>
            <?php
          }else{ ?>
            <li><a href="noticias.php?pag=<?php echo $IncrimentNum ?>&noticia=nkuroinku">Siguiente <i class="glyphicon glyphicon-chevron-right"></i></a></li>
          <?php
          }
          ?>
        </ul>
    </nav>
  </center>
