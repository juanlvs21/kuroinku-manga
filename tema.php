<?php
    include("config/conexion.php");

    session_start();

    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php');
    }

    //Buscando nombre del usuario
    $usuario =  $_SESSION['usuario'];
    $query = "SELECT * FROM usuario WHERE usuario='$usuario'";
    $result = $conexion->query($query);
    $row = $result->fetch_assoc();
    $yo = $row['id'];

    $id = $_GET['id'];

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="dist/img/favicon.ico" type="imege/x-icon">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kuroinku | Tema</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- SCRIP SCROLL-->
  <script src="bower_components/jquery/jquery.jscroll.js"></script>
  <!-- ESTILO SCROLL -->
  <!--style type="text/css">
    .scroll{
      width: 100%;
    }

    .scroll .jscroll-loading{
      width: 10%;
      margin: -500px auto;
    }
  </style-->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

 <!-- Google Font -->
  <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"-->
  
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <!-- INICIO HEADER -->
  <?php
  include("header.php");
  ?>
  <!-- /FIN HEADER -->

  <!-- Left side column. contains the logo and sidebar -->
  <!-- INICIO SIDEBER -->
  <?php
  include("siderbar.php");
  ?>
  <!-- /FIN SIDERBAR -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <a href="index.php" style="color: black">Kuroinku</a>
        <small><a href="tema.php?id=<?php echo $id ?>" style="color: black;">Tema</a></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Kuroinku</a></li>
        <li><a href="tema.php?id=<?php echo $id ?>" style="color: black">Tema</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!--PUBLICACION MANGAS-->
        <section class="col-lg-8 col-lg-offset-2">
          <?php 
          $querypubli = ($conexion->query("SELECT * FROM publicacion WHERE id='$id' AND desactivada='0'"))->fetch_assoc();
          $userp = $querypubli['id_usuario'];
          $queryuser = ($conexion->query("SELECT nombre,apellido,verificado,foto FROM usuario WHERE id='$userp'"))->fetch_assoc();
          
          $nombreapellido = $queryuser['nombre']." ".$queryuser['apellido'];

          ?>
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img  src="avatar/<?php echo $queryuser['foto']; ?>" style="clip-path: circle(50% at center);" alt="User Image" height="40" width="auto">
                <?php
                if ($queryuser['verificado'] != 0) { ?>
                  <span class="description" onclick="location.href='perfil.php?id=<?php echo $queryuser['id'];?>&perfil=publicacionesp';" style="cursor:pointer; color: red;"><?php echo $nombreapellido;?><i class="fa fa-check"></i></span>
                <?php
                }else{ ?>
                  <span class="description" onclick="location.href='perfil.php?id=<?php echo $queryuser['id'];?>&perfil=publicacionesp';" style="cursor:pointer; color: red;"><?php echo $nombreapellido;?></span>
                <?php
                }
                //if ($use['editor']==1) { ?>
                  <!--span class="description"><i style="color: green;"> Editor<a class="fa fa-pencil" style="  color: green;"></a></i></span>
                <-?php
                }
                ?-->
                <span class="description"><?php echo $querypubli['fecha'];?></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <script>
                  function eliminar(id){
                    if (confirm('¿Esta seguro que desea eliminar esta publicación?')) {
                      var datos = 'id='+id;
                      $.ajax({
                        type: "POST",
                            url: "real/eliminarpublicacion_individual.php",
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
                if ($userp == $yo) {
                  ?>
                  <button type="button" title="Eliminar publicación" class="btn btn-box-tool" onclick="eliminar(<?php echo $querypubli['id'] ?>);"><i class="fa fa-remove"></i>
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
              <center><h2><?php echo $querypubli['titulo'] ?></h2></center>
              <p><?php echo $querypubli['contenido'];?></p>

              <?php
              if($querypubli['img'] != 0){
                $file = "publicaciones/".$querypubli['img'];  // Dirección de la imagen
               
                $imagen = getimagesize($file);    //Sacamos la información
                $ancho = $imagen[0];              //Ancho
                $alto = $imagen[1];               //Alto
            
                if ($ancho > $alto) {
                  ?>
                      <center>
                        <a data-lightbox="roadtrip" data-title="<a href='perfil.php?id=<?php echo $idusersesion;?>&perfil=publicacionesp' style='color: red;'><?php echo $nombreapellido;?></a> | <?php echo $querypubli['fecha'] ?> <br> <?php echo $querypubli['contenido'] ?>" href="publicaciones/<?php echo $querypubli['img'];?>">
                        <img class="img-responsive" src="publicaciones/<?php echo $querypubli['img'];?>" height="auto" width="500">
                        </a> 
                      </center> 
                  <?php
                }
                if ($alto > $ancho) {
                      ?> 
                      <center>
                        <a data-lightbox="roadtrip" data-title="<a href='perfil.php?id=<?php echo $idusersesion;?>&perfil=publicacionesp' style='color: red;'><?php echo $nombreapellido;?></a> | <?php echo $querypubli['fecha'] ?> <br> <?php echo $querypubli['contenido'] ?>" href="publicaciones/<?php echo $querypubli['img'];?>">
                        <img class="img-responsive" src="publicaciones/<?php echo $querypubli['img'];?>" height="300" width="auto">
                        </a> 
                      </center>            
                      <?php
                }
              }
              
              $querync = "SELECT * FROM comentario WHERE id_publicacion = '".$querypubli['id']."' AND desactivado='0' ";
              $resultnc = $conexion->query($querync);
              $numcomen = $resultnc->num_rows;
              ?>
              <!-- Social sharing buttons -->
              <ul class="list-inline"-->
              <?php
              //$query = mysql_query("SELECT * FROM likes WHERE post = '".$lista['id_pub']."' AND usuario = ".$_SESSION['id']."");

              //if (mysql_num_rows($query) == 0) { ?>
                <!--li><div class="btn btn-default btn-xs like" id="<-?php echo $lista['id_pub']; ?>"><i class="fa fa-thumbs-o-up"></i> Me gusta </div><span id="likes_<-?php echo $lista['id_pub']; ?>"> (<-?php echo $lista['likes']; ?>)</span></li-->
              <?php
              //}else{ ?>
                <!--li><div class="btn btn-default btn-xs like" id="<-?php echo $lista['id_pub']; ?>"><i class="fa fa-thumbs-o-up"></i> No me gusta </div><span id="likes_<-?php echo $lista['id_pub']; ?>"> (<-?php echo $lista['likes']; ?>)</span></li-->
              <?php
              //} ?>
                <br>
                <li class="pull-right">
                  <span href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Respuestas
                  (<?php echo $numcomen; ?>)</span>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- OPINIONES -->
          <div class="panel-body box box-footer">
              <center>
                <h3>Respuestas</h3>
              </center>
              <hr style="color: #0056b2;" />
              <center><a href="#" class="btn btn-danger btn-sm btn-block" style="width: 200px" role="button" data-toggle="modal" data-target="#modalresponder"><span class="fa fa-pencil"></span> Responder</a></center>
              <br>
              <ul class="list-group">
                  <?php
                  $queryopinion = "SELECT * FROM comentario WHERE id_publicacion='$id' ORDER BY fecha DESC";
                  $opinion = $conexion->query($queryopinion);

                  while($opi = $opinion->fetch_assoc()){
                    $queryusup = "SELECT * FROM usuario WHERE id = '".$opi['id_usuario']."'";
                    $usuariop = $conexion->query($queryusup);
                    $usep = $usuariop->fetch_assoc();
                    ?>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                                <img src="avatar/<?php echo $usep['foto'];?>" class="img-circle" alt="" style="width: 50px; height: 50px;"/>
                              </div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <span>
                                      <a href="perfil.php?id=<?php echo $usep['id'];?>&perfil=publicacionesp'" style="color: red"><b><?php echo $usep['nombre']." ".$usep['apellido'] ?></b></a>
                                      <span class="text-muted pull-right">
                                        <?php 
                                        if ($opi['id_usuario'] == $yo) {
                                          ?>
                                          <button type="button" title="Eliminar opinion" class="btn btn-box-tool" onclick="eliminarcomentario(<?php echo $com['id'] ?>);"><i class="fa fa-remove"></i>
                                          </button>
                                          <div id="eliminadocomentario"></div>
                                          <?php
                                        }
                                        ?>                                  
                                      </span> 
                                      <?php echo " | ".$opi['fecha'] ?>                                     
                                    </span>
                                </div>
                                <div class="comment-text">
                                    <?php echo $opi['comentario'] ?>
                                </div>
                            </div>
                        </div>
                    </li>
                  <?php
                  }
                  ?>
              </ul>
          </div><!-- FIN OPINION -->          
        </section>
        <!-- /NOTICIAS MANGAS-->
        <!-- NOTICIAS KIROINKU-->

        <!-- /NOTICIAS KIROINKU -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!--MODAL RESPONDER -->
      <div class="modal fade" id="modalresponder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!-- si quitas data-dismiss="modal" no se cierra el modal con un alert-->
                <center><h4>Respuesta</h4></center>
              </div>
              <div class="modal-body"><!--#Body modal-->
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="input-group">
                    <input type="hidden" id="idtema" value="<?php echo $id ?>">
                    <textarea name="respuesta" onkeypress="return validarn(event)" id="publicacion" placeholder="Respuesta" class="form-control" cols="200" rows="3" required></textarea> 
                    <br>
                    <button type="submit" name="publicar"  id="publicar" class="btn btn-danger btn-flat">Responder</button>
                  </div>
                </form>

                <?php
                if(isset($_POST['publicar'])){
                  $respuesta = mysqli_real_escape_string($conexion,$_POST['respuesta']);
          
                    $subir_query = "INSERT INTO comentario (id_usuario,fecha,comentario, id_publicacion, desactivado) values ('".$_SESSION['id']."',now(),'$respuesta','$id', 0)";
                    $subir_result = $conexion->query($subir_query);
                    if ($subir_result) {
                      ?> 
                      <script>
                        var id = document.getElementById('idtema').value;
                        console.log('Respuesta realizada en el tema '+id);
                        window.location.replace('tema.php?id='+id);
                      </script>                      
                      <?php
                    }else{
                        ?>
                      <script>alert('Error al publicar respuesta');</script>
                      <?php
                    }   
                }
                ?>           
                <div id="resultopinar2"></div>      
              </div><!--/#Body modal editar datos-->

              <div class="modal-footer">
                <button type="button" name="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
              </div>

            </div>
        </div>
      </div>
  <!-- FIN MODAL RESPONDER -->  

  <!-- FOOTER -->
  <?php include('footer.php'); ?>
  <!-- /FOOTER -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- SCRIPT PARA CARGAR MENSAJES EN TIEMPO REAL -->
<script src="real/cargarmensajes.js"></script>
<!-- SCRIPT PARA CARGAR NOTIFICACIONES EN TIEMPO REAL -->
<script src="real/cargarnotificaciones.js"></script>
<!-- SCRIPT PARA CARGAR NUMERO MENSAJES HEADER EN TIEMPO REAL -->
<script src="real/bnm-header.js"></script>
<!-- SCRIPT PARA CARGAR NUMERO MENSAJES SIDEBAR EN TIEMPO REAL -->
<script src="real/bnm-sidebar.js"></script>
<!-- SCRIPT PARA CARGAR NUMERO NOTIFICACIONES EN TIEMPO REAL -->
<script src="real/bnnotifi.js"></script>
</body>
</html>
