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
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="dist/img/favicon.ico" type="imege/x-icon">
  <title>Kuroinku | Mangas</title>
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
  <!-- Archivos modificar el input file -->
  <link rel="stylesheet" type="text/css" href="dist/css/component.css" />
  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"-->

  <!-- SCRIPT PARA IMPEDIR ETIQUETAS EN LAS PUBLICACIONES -->

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
  <script>
    $(buscarmanga());

    function buscarmanga(mangas){
      $.ajax({
        url: 'real/buscarmanga.php',
        type: 'POST',
        dateType: 'html',
        data: {mangas: mangas},
      })
      .done(function(respuesta){
        $("#listamangas").html(respuesta);
      })
      .fail(function(respuesta){
        console.log('Error al buscar manga');
      })

    };

    $(document).on('keyup', '#buscarmanga', function(){
      var valorManga = $(this).val();

      if (valorManga!="") {
        buscarmanga(valorManga);
      }else{
        buscarmanga();
      }
    });  

    $(document).on('click', '#search-btn', function(){
      var genero = document.getElementById('genero').value;
      buscarmanga(genero);
    });
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
    <section class="content-header">
      <h1>
        <a href="index.php" style="color: black">Kuroinku</a>
        <small><a href="mangas.php" style="color: black">Mangas</a></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Kuroinku</a></li>
        <li class="active"><a href="mangas.php">Mangas</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <?php 
        if (($row['editor'] == 1)||($row['admin'] == 1)) {
          ?>
          <section class="col-lg-4 "> <!-- connectedSortable hace que se puedan mover libremente-->

            <!-- Buscar Magas box -->
            <div class="box box-solid bg-red-gradient">
              <div class="box-header">
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button type="button" class="btn btn-default btn-sm pull-right" data-widget="collapse"
                          data-toggle="tooltip" title="Minimizar" style="margin-right: 5px;">
                    <i class="fa fa-minus"></i></button>
                </div>
                <!-- /. tools -->

                <i class="fa fa-folder-open"></i>

                <h3 class="box-title">
                  Buscar Mangas
                </h3>
              </div>
              <div class="box-body">
                 <input type="text" name="q" id="buscarmanga"  class="form-control" placeholder="Buscar Manga">
                <!--form action="#" method="get">
                  <div class="input-group">
                    <input type="text" name="q" id="buscarmanga"  class="form-control" placeholder="Buscar Manga">
                    <span class="input-group-btn">
                          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                          </button>
                        </span>
                  </div>
                </form-->
              </div>
            </div>
            <!-- /.box  -->

          </section>
          <section class="col-lg-4"> <!-- connectedSortable hace que se puedan mover libremente-->

            <!-- Buscar Manga Categoria  box -->
            <div class="box box-solid bg-red-gradient">
              <div class="box-header">
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button type="button" class="btn btn-default btn-sm pull-right" data-widget="collapse"
                          data-toggle="tooltip" title="Minimizar" style="margin-right: 5px;">
                    <i class="fa fa-minus"></i></button>
                </div>
                <!-- /. tools -->

                <i class="fa fa-folder-open"></i>

                <h3 class="box-title">
                  Elegir Categoria
                </h3>
              </div>
              <div class="box-body">
                  <div class="input-group">
                    <select class="form-control" name="genero" id="genero" required="">
                      <option value="">Elija una opción</option>
                      <option value="Accion">Acción</option>
                      <option value="Artes Marciales">Artes Marciales</option>
                      <option value="Aventura">Aventura</option>
                      <option value="Ciencia Ficción">Ciencia Ficción</option>
                      <option value="Comedia">Comedia</option>
                      <option value="Deporte">Deporte</option>
                      <option value="Doujinshi">Doujinshi</option>
                      <option value="Drama">Drama</option>
                      <option value="Ecchi">Ecchi</option>
                      <option value="Escolar">Escolar</option>
                      <option value="Fantasía">Fantasía</option>
                      <option value="Gender Bender">Gender Bender</option>
                      <option value="Gore">Gore</option>
                      <option value="Harem">Harem</option>
                      <option value="Histórico">Histórico</option>
                      <option value="Horror">Horror</option>
                      <option value="Lolicon">Lolicon</option>
                      <option value="Magia">Magia</option>
                      <option value="Mecha">Mecha</option>
                      <option value="Misterio">Misterio</option>
                      <option value="Musical">Musical</option>
                      <option value="One-Shot">One-Shot</option>
                      <option value="Parodia">Parodia</option>
                      <option value="Policíaca">Policíaca</option>
                      <option value="Psicológica">Psicológica</option>
                      <option value="Romance">Romance</option>
                      <option value="Shojo Ai">Shojo Ai</option>
                      <option value="Shonnen Ai">Shonnen Ai</option>
                      <option value="Shota">Shota</option>
                      <option value="Slice of Life">Slice of Life</option>
                      <option value="Smut">Smut</option>
                      <option value="Sobrenatural">Sobrenatural</option>
                      <option value="Superpoderes">Superpoderes</option>
                      <option value="Tragedia">Tragedia</option>
                    </select>      
                    <span class="input-group-btn">
                          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                          </button>
                    </span>
                  </div>
              </div>
            </div>
            <!-- /.box  -->
          </section>
          <section class="col-lg-4"> <!-- connectedSortable hace que se puedan mover libremente-->

            <!-- Buscar Manga Categoria  box -->
            <div class="box box-solid bg-red-gradient">
              <div class="box-header">
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button type="button" class="btn btn-default btn-sm pull-right" data-widget="collapse"
                          data-toggle="tooltip" title="Minimizar" style="margin-right: 5px;">
                    <i class="fa fa-minus"></i></button>
                </div>
                <!-- /. tools -->

                <i class="fa fa-folder-open"></i>

                <h3 class="box-title">
                  Subir Manga
                </h3>
              </div>
              <div class="box-body">
                <center>
                  <button type="button" class="btn btn-default" style="width: 200px" data-toggle="modal" data-target="#modalsubirmanga">Subir</button>
                </center>
              </div>
            </div>
            <!-- /.box  -->
          </section>
          <?php
        }else{
          ?>
          <section class="col-lg-6 "> <!-- connectedSortable hace que se puedan mover libremente-->
            <!-- Buscar Mangas box -->
            <div class="box box-solid bg-red-gradient">
              <div class="box-header">
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button type="button" class="btn btn-default btn-sm pull-right" data-widget="collapse"
                          data-toggle="tooltip" title="Minimizar" style="margin-right: 5px;">
                    <i class="fa fa-minus"></i></button>
                </div>
                <!-- /. tools -->

                <i class="fa fa-folder-open"></i>

                <h3 class="box-title">
                  Buscar Mangas
                </h3>
              </div>
              <div class="box-body">
                <form action="#" method="get">
                  <div class="input-group">
                    <input type="text" name="q" class="form-control" id="buscarmanga" placeholder="Buscar Manga">
                    <span class="input-group-btn">
                          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                          </button>
                        </span>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box  -->

          </section>
          <section class="col-lg-6"> <!-- connectedSortable hace que se puedan mover libremente-->

            <!-- Buscar Manga Categoria  box -->
            <div class="box box-solid bg-red-gradient">
              <div class="box-header">
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button type="button" class="btn btn-default btn-sm pull-right" data-widget="collapse"
                          data-toggle="tooltip" title="Minimizar" style="margin-right: 5px;">
                    <i class="fa fa-minus"></i></button>
                </div>
                <!-- /. tools -->

                <i class="fa fa-folder-open"></i>

                <h3 class="box-title">
                  Elegir Categoria
                </h3>
              </div>
              <div class="box-body">
                <form action="#" method="get">
                  <div class="input-group">
                    <select class="form-control" name="genero" id="genero">
                      <option value="">Elija una opción</option>
                      <option value="Accion">Acción</option>
                      <option value="Artes Marciales">Artes Marciales</option>
                      <option value="Aventura">Aventura</option>
                      <option value="Ciencia Ficción">Ciencia Ficción</option>
                      <option value="Comedia">Comedia</option>
                      <option value="Deporte">Deporte</option>
                      <option value="Doujinshi">Doujinshi</option>
                      <option value="Drama">Drama</option>
                      <option value="Ecchi">Ecchi</option>
                      <option value="Escolar">Escolar</option>
                      <option value="Fantasía">Fantasía</option>
                      <option value="Gender Bender">Gender Bender</option>
                      <option value="Gore">Gore</option>
                      <option value="Harem">Harem</option>
                      <option value="Histórico">Histórico</option>
                      <option value="Horror">Horror</option>
                      <option value="Lolicon">Lolicon</option>
                      <option value="Magia">Magia</option>
                      <option value="Mecha">Mecha</option>
                      <option value="Misterio">Misterio</option>
                      <option value="Musical">Musical</option>
                      <option value="One-Shot">One-Shot</option>
                      <option value="Parodia">Parodia</option>
                      <option value="Policíaca">Policíaca</option>
                      <option value="Psicológica">Psicológica</option>
                      <option value="Romance">Romance</option>
                      <option value="Shojo Ai">Shojo Ai</option>
                      <option value="Shonnen Ai">Shonnen Ai</option>
                      <option value="Shota">Shota</option>
                      <option value="Slice of Life">Slice of Life</option>
                      <option value="Smut">Smut</option>
                      <option value="Sobrenatural">Sobrenatural</option>
                      <option value="Superpoderes">Superpoderes</option>
                      <option value="Tragedia">Tragedia</option>
                    </select>     
                    <span class="input-group-btn">
                          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                          </button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box  -->
          </section>
          <?php
        }
        ?>
        <!-- Left col -->
        <section class="col-lg-12">
          </div>
          <!-- codigo scroll -->
          <div class="row" id="listamangas">
            <?php //require_once "real/buscarmanga.php"; ?>
          </div>

        </section>
        <!-- /.Left col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--MODAL SUBIR MANGA -->
      <div class="modal fade" id="modalsubirmanga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!-- si quitas data-dismiss="modal" no se cierra el modal con un alert-->
                <center><h4>Subir Manga</h4></center>
              </div>

              <div class="modal-body"><!--#Body modal comentar-->
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="nombre">Nombre:</label>
                      <input type="text" class="form-control" placeholder="Nombre" id="nombre" name="nombre" required="">
                  </div>     
                  <div class="form-group">
                    <label for="genero">Género:</label>
                    <select class="form-control" name="genero" id="genero" required="">
                      <option value="">Elija una opción</option>
                      <option value="Accion">Acción</option>
                      <option value="Artes Marciales">Artes Marciales</option>
                      <option value="Aventura">Aventura</option>
                      <option value="Ciencia Ficción">Ciencia Ficción</option>
                      <option value="Comedia">Comedia</option>
                      <option value="Deporte">Deporte</option>
                      <option value="Doujinshi">Doujinshi</option>
                      <option value="Drama">Drama</option>
                      <option value="Ecchi">Ecchi</option>
                      <option value="Escolar">Escolar</option>
                      <option value="Fantasía">Fantasía</option>
                      <option value="Gender Bender">Gender Bender</option>
                      <option value="Gore">Gore</option>
                      <option value="Harem">Harem</option>
                      <option value="Histórico">Histórico</option>
                      <option value="Horror">Horror</option>
                      <option value="Lolicon">Lolicon</option>
                      <option value="Magia">Magia</option>
                      <option value="Mecha">Mecha</option>
                      <option value="Misterio">Misterio</option>
                      <option value="Musical">Musical</option>
                      <option value="One-Shot">One-Shot</option>
                      <option value="Parodia">Parodia</option>
                      <option value="Policíaca">Policíaca</option>
                      <option value="Psicológica">Psicológica</option>
                      <option value="Romance">Romance</option>
                      <option value="Shojo Ai">Shojo Ai</option>
                      <option value="Shonnen Ai">Shonnen Ai</option>
                      <option value="Shota">Shota</option>
                      <option value="Slice of Life">Slice of Life</option>
                      <option value="Smut">Smut</option>
                      <option value="Sobrenatural">Sobrenatural</option>
                      <option value="Superpoderes">Superpoderes</option>
                      <option value="Tragedia">Tragedia</option>
                    </select>         
                  </div>   
                  <div class="form-group">
                    <label for="temporada">Temporada:</label>
                      <input type="number" class="form-control" placeholder="Temporada" id="temporada" name="temporada" value="1" required="">
                  </div>   
                  <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select class="form-control" name="estado" id="estado" required="">
                      <option value="Finalizado">Finalizado</option>
                      <option value="En curso">En curso</option>
                    </select>         
                  </div>  
                  <div class="form-group">
                    <label for="creador">Creador:</label>
                      <input type="text" class="form-control" placeholder="Creador" id="creador" name="creador">
                  </div>       
                  <div class="form-group">
                    <label for="fecha_pub">Fecha de publicación:</label>
                      <input type="date" class="form-control" id="fecha_pub" name="fecha_pub">
                  </div>        
                  <div class="form-group">
                    <label for="portada">Fotografia de portada:</label>
                      <input type="file" class="form-control" id="portada" name="portada">
                  </div>        
                  <div class="form-group">
                    <center>
                      <button type="submit" class="btn btn-success" id="btnsubir" name="btnsubir">Subir Manga</button>
                    </center>
                  </div>                                 
                </form>
                <?php
                if(isset($_POST['btnsubir'])){
                  $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
                  $genero = mysqli_real_escape_string($conexion, $_POST['genero']);
                  $temporada = mysqli_real_escape_string($conexion, $_POST['temporada']);
                  $creador = mysqli_real_escape_string($conexion, $_POST['creador']);
                  $fecha_pu = mysqli_real_escape_string($conexion, $_POST['fecha_pub']);
                  $estado = mysqli_real_escape_string($conexion, $_POST['estado']);

                  $userpublic = $_SESSION['id'];
                  $fecha_pub = date_format((new DateTime($fecha_pu)), 'Y-m-d');

                  $type = 'jpg';
                  $rfoto = $_FILES['portada']['tmp_name'];
                  $name = "portada.".$type;

                  if(is_uploaded_file($rfoto)){
                    $carpeta = str_replace(" ", "", $nombre);
                    mkdir("mangas/".$carpeta, 0777, true);
                    $img_destino = "mangas/".$carpeta."/".$name;
                    $img_nombre = $name;
                    copy($rfoto, $img_destino);

                    $subir_query = "INSERT INTO manga (nombre,genero,temporada,creador,fecha_pub,portada,id_usuario,publicado, estado) values ('$nombre','$genero','$temporada','$creador', '$fecha_pub', '$img_nombre', '$userpublic','0', '$estado')";
                    $subir_result = $conexion->query($subir_query);
                    if ($subir_result) {
                        ?>
                      <script>
                        console.log('Manga subido');
                        window.location.replace('mangas.php');
                      </script>
                      <?php                      
                    }else{
                        ?>
                      <input type="hidden" id="errorq" value="<?php echo $conexion->error ?>">
                      <script>
                        var error = document.getElementById('errorq').value;
                        console.log('Error al subir el manga');
                        console.log(error);
                      </script>
                      <?php
                    } 
                  }else{
                        ?>
                      <script>console.log('Error al subir la portada');</script>
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
  <!-- FIN MODAL SUBIR MANGA -->
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

<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<!--script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script-->
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
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
