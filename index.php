<?php
    include("config/conexion.php");

    session_start();

    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
    }

    //Buscando nombre del usuario
    $usuario =  $_SESSION['usuario'];
    $query = "SELECT * FROM usuario WHERE usuario='$usuario'";
    $result = $conexion->query($query);
    $row = $result->fetch_assoc();
    $yo = $row['id'];

    $idnumperfilusu = mysqli_real_escape_string($conexion,$row['id']);

    $querynumseguidores = "SELECT * FROM seguidores WHERE seguido='$idnumperfilusu'";
    $resultnumseguidores = $conexion->query($querynumseguidores);
    $numseguidores = $resultnumseguidores->num_rows;

    $querynumseguidos = "SELECT * FROM seguidores WHERE seguidor='$idnumperfilusu'";
    $resultnumseguidos = $conexion->query($querynumseguidos);
    $numseguidos = $resultnumseguidos->num_rows;

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="dist/img/favicon.ico" type="imege/x-icon">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kuroinku | Inicio</title>
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
  <!-- LIGHT BOX PARA LAS FOTOGRAFIAS -->
  <link href="dist/css/lightbox.css" rel="stylesheet">
  <!-- TEMAS RECIENTES -->
  <link href="dist/css/temasrecientes.css" rel="stylesheet">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"-->

  <!-- SCRIPT PARA IMPEDIR ETIQUETAS EN LAS PUBLICACIONES -->
  <script type="text/javascript">
    function validarn(e){
      tecla = (document.all) ? e.keyCode : e.which;
      if(tecla == 8) return true;
      if(tecla == 9) return true;
      if(tecla == 11) return true;

      patron = /[A-Za-zñ¡!#$%&()=?¿¡*+0-9-:;_'.,<^´ ]/;

      te = String.fromCharCode(tecla);

      return patron.test(te);
    }
  </script>

  <!-- /FIN SCRIPT PARA IMPEDIR ETIQUETAS EN LAS PUBLICACIONES -->
  <script>
    /*$(function(){
      $("#publicar").click(function(){
        event.preventDefault();
        var publicacion = document.getElementById("publicacion").value;
        var archivo = document.getElementById("archivo").file[0];

        $("#publicacion").val("");

        var publicacion = 'publicacion='+publicacion;
        publicacion += '&archivo='+archivo;

        if (publicacion == "") {
        }else{
          $.ajax({
              type: "POST",
              url: "publicar.php",
              data: publicacion,
              dataType:"html",
              asycn:false,
              success: function(){
                console.log('Datos enviados');
              }
          })
          .done(function(respuesta2){
              console.log('Consulta Realizada');
          })
          .fail(function(respuesta2){
              console.log('error');
          })
        }
      });
    });*/
  </script>

</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

<?php 
  include("header.php");
?>

  <!-- Left side column. contains the logo and sidebar -->
<?php 
  include("siderbar.php");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--section class="content-header">
      <h1>
        Kuroinku
        <small>Inicio</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Kuroinku</a></li>
        <li class="active">inicio</li>
      </ol>
    </section-->

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-8">

          <div id="nvapublicacion"></div>

          <div class="  box-footer box box-danger">
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

          </div>
          <!-- codigo scroll -->
          <div class="scroll box box-footer" >
            <?php //require_once "temas-recientes.php"; ?>
            <?php require_once "publicaciones.php"; ?>
          </div>

          <script>
            /*$(document).ready(function(){
              $('.scroll').scroll({
                loadingHtml:'<img src="dist/img/loading.gif" alt="Loading">';
              });
            });*/
          </script>

        </section>
        <!-- /.Left col -->

        <section class="col-lg-4"> <!-- connectedSortable hace que se puedan mover libremente-->
          <!-- Ultimos Subidos box -->
          <div class="box box-solid bg-red-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!--button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip"
                        title="Date range">
                  <i class="fa fa-calendar"></i></button-->
                <button type="button" class="btn btn-default btn-sm pull-right" data-widget="collapse"
                        data-toggle="tooltip" title="Minimizar" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-folder-open"></i>

              <h3 class="box-title">
                Ultimos Mangas Subidos
              </h3>
            </div>
            <div class="box-body">
              <!--div id="world-map" style="height: 250px; width: 100%;"></div-->

              <!--  ULTIMOS MANGAS SUBIDOS  -->
              <div class="box-body no-padding">
                <ul class="users-list clearfix">
                <?php
                $subidos_query = "SELECT id,nombre,genero,fecha_pub FROM manga WHERE publicado='1' order by id desc limit 8";
                $subidos_result = $conexion->query($subidos_query);

                while($subidos_row= $subidos_result->fetch_assoc()) {
                  $idmang = $subidos_row['id'];
                ?>
                  <li class="box box-solid box-default">
                    <a class="users-list-name" href="manga.php?id=<?php echo $idmang ?>"><?php echo $subidos_row['nombre']; ?></a>
                    <span class="users-list-date"><?php echo $subidos_row['fecha_pub']; ?></span>
                  </li>
                <?php
                }
                ?>
                </ul>
                <!-- /.users-list -->
              </div>
              <!--  /FIN ULTIMOS MANGAS SUBIDOS-->

            </div>
            <!-- /.box-body-->
            <!--div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center col-xs-offset-4" style="border-right: 1px solid #f4f4f4"-->
                  <!--div id="sparkline-1"></div-->
                  <!--div class="knob-label">
                    <-?php
                    $subidos_num = $subidos_result->num_rows;
                    ?>
                    <b><h2><-?php echo $subidos_num; ?></h2></b>
                    Total subidos</div>
                </div-->
                <!-- ./col -->
              <!--/div-->
              <!-- /.row -->
            <!--/div-->
          </div>
          <!-- /.box  -->

          <!-- Noticias box -->
          <div class="box box-solid bg-red-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!--button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip"
                        title="Date range">
                  <i class="fa fa-calendar"></i></button-->
                <button type="button" class="btn btn-default btn-sm pull-right" data-widget="collapse"
                        data-toggle="tooltip" title="Minimizar" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-newspaper-o"></i>

              <h3 class="box-title">
                <a href="noticias.php?noticia=nmangas" style="color:white;">Ultimas Noticias</a>
              </h3>
            </div>
            <div class="box-body">
              <!--div id="world-map" style="height: 250px; width: 100%;"></div-->

              <!--  ULTIMOS MANGAS SUBIDOS  -->
              <div class="box-body no-padding">
                <ul class="list-unstyled clearfix">
                <?php
                $querynoticias = "SELECT id,titulo,fecha,prev,noticia FROM noticia order by id desc limit 4";
                $resultnoticias = $conexion->query($querynoticias);

                while($rownoticia = $resultnoticias->fetch_assoc()) {
                ?>
                  <li class="box box-solid box-default">
                    <center>
                      <a class="users-list-name" data-toggle="modal" data-target="#modalnoticia<?php echo $rownoticia['id']; ?>"><?php echo $rownoticia['titulo']; ?></a>
                      <span class="users-list-date"><?php echo $rownoticia['fecha']; ?></span>
                      <span class="users-list-date"><?php echo $rownoticia['prev']; ?></span>
                    </center>
                  </li>
                  <!--MODAL NOTICIA -->
                  <div class="modal fade" id="modalnoticia<?php echo $rownoticia['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <!-- si quitas data-dismiss="modal" no se cierra el modal con un alert-->
                            <center>
                              <h4 style="color:black;"><?php echo $rownoticia['titulo']; ?></h4>
                              <small style="color:black;"><?php echo $rownoticia['fecha']; ?></small>
                            </center>
                          </div>

                          <div class="modal-body"><!--#Body modal comentar-->
                            <p style="color:black;"><?php echo $rownoticia['noticia']; ?></p>
                          </div><!--/#Body modal editar datos-->

                          <div class="modal-footer">
                            <button type="button" name="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
                          </div>

                        </div>
                    </div>
                  </div>
                  <!-- FIN MODAL NOTICIA -->

                <?php
                }
                ?>
                </ul>
                <!-- /.users-list -->
              </div>
              <!--  /FIN ULTIMOS MANGAS SUBIDOS-->

            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box Noticias -->

        </section>        
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- FOOTER-->
  <?php include('footer.php'); ?>
  <!-- /FOOTER-->
  
  <!-- Control Sidebar -->

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
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- SCRIPT PARA CARGAR NOTIFICACIONES EN TIEMPO REAL -->
<script src="real/cargarnotificaciones.js"></script>
<!-- SCRIPT PARA CARGAR MENSAJES EN TIEMPO REAL -->
<script src="real/cargarmensajes.js"></script>
<!-- SCRIPT PARA CARGAR NUMERO NOTIFICACIONES EN TIEMPO REAL -->
<script src="real/bnnotifi.js"></script>
<!-- SCRIPT PARA CARGAR NUMERO MENSAJES HEADER EN TIEMPO REAL -->
<script src="real/bnm-header.js"></script>
<!-- SCRIPT PARA CARGAR NUMERO MENSAJES SIDEBAR EN TIEMPO REAL -->
<script src="real/bnm-sidebar.js"></script>
<!-- SCRIPT LIGHTBOX -->
<script src="dist/js/lightbox.js"></script>
</body>
</html>
