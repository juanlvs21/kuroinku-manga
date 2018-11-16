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

    $idmanga = mysqli_real_escape_string($conexion, $_GET['manga']);
    $querymanga = ($conexion->query("SELECT * FROM manga WHERE id='$idmanga'"))->fetch_assoc();

    $idcap = mysqli_real_escape_string($conexion, $_GET['cap']);
    $querycap = ($conexion->query("SELECT * FROM capitulo WHERE cap='$idcap' AND id_manga='$idmanga'"))->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="dist/img/favicon.ico" type="imege/x-icon">
  <title>Kuroinku | <?php echo $querymanga['nombre'] ?></title>
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
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Archivos modificar el input file -->
  <link rel="stylesheet" type="text/css" href="dist/css/component.css" />
  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- LIGHT BOX PARA LAS FOTOGRAFIAS -->
  <link href="dist/css/lightbox.css" rel="stylesheet">

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
        <small><a href="mangas.php" style="color: black;">Mangas</a></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Kuroinku</a></li>
        <li><a href="mangas.php" style="color: black">Mangas</a></li>
        <li class="active"><a href="manga.php?id=<?php echo $idmanga ?>" style="color: black"><?php echo $querymanga['nombre'] ?></a></li>
        <li class="active"><a href="capitulo.php?manga=<?php echo $idmanga."&cap=".$idcap ?>" style="color: black">Capitulo <?php echo $idcap ?></a></li>
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
                  Subir páginas
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

                <i class="fa fa-send"></i>

                <h3 class="box-title">
                  Publicar capitulo
                </h3>
              </div>
              <div class="box-body">
                <center>
                  <form action="" method="post">
                    <div class="form-group">
                      <?php 
                      if ($querycap['publicado'] == 0) {
                        ?>
                        <h4> Publicado: <b>No</b></h4>
                        <?php
                      }else{
                        ?>
                        <h4> Publicado: <b>Si</b></h4>
                        <?php                        
                      }
                      ?>
                    </div>
                    <input type="hidden" value="<?php echo $idmanga ?>" id="idm">
                    <input type="hidden" value="<?php echo $idcap ?>" id="idc">
                    <div class="form-group">
                      <div class="col-md-6">
                        <select class="form-control" name="publicar" id="publicar" required="">
                          <option value="">Elija una opción</option>
                          <option value="1">Si</option>
                          <option value="0">No</option>
                        </select> 
                      </div>     
                      <button type="submit" class="btn btn-success col-md-6" onclick="publicarc()" name="btnpublicar">Publicar</button>         
                    </div>
                  </form>
                  <?php 
                  if (isset($_POST['btnpublicar'])) {
                     $publicar = mysqli_real_escape_string($conexion, $_POST['publicar']);
                     $querypublicarc = $conexion->query("UPDATE capitulo SET publicado='$publicar' WHERE id_manga='$idmanga' AND cap='$idcap'");

                     if ($querypublicarc) {
                       ?>
                        <script>
                          console.log('Capitulo publicado - Código = 1');
                          var id = document.getElementById('idm').value;
                          var cap = document.getElementById('idc').value;
                          window.location.replace('capitulo.php?manga='+id+'&cap='+cap);
                        </script>
                       <?php
                       exit;
                     }else{
                       ?>
                        <script>console.log('Capitulo no publicado - Código = 0');</script>
                       <?php                    
                     }
                  }
                  ?>
                </center>
              </div>
            </div>
            <!-- /.box  -->
          </section>
          <?php
        }
        ?>
        <!-- Left col -->
        <section class="col-lg-12">
          <div class="box box-footer">
            <div class="box-title">
              <center>
                <h1><?php echo $querymanga['nombre'] ?></h1>
                <h3><?php echo $querycap['nombre'] ?><small><?php echo " Capitulo ".$idcap?></small></h3>
              </center>
            </div>
            <div class="box-body">
              <center>
                  <p><?php echo "Género: ".$querymanga['genero']."  |  Temporada: ".$querymanga['temporada']."  |  Estado: ".$querymanga['estado']."  |  Creador: ".$querymanga['creador']."  |  Fecha de publicacion: ".$querymanga['fecha_pub'] ?></p>                
                <?php
                if ($querycap['creditos'] != NULL) {
                  ?>
                  <p>Capítulo cortesía de: <a href="<?php echo $querycap['url_creditos'] ?>"><b><?php echo $querycap['creditos'] ?></b></a></p>
                  <?php
                }
                ?>
              </center>
            </div>
          </div>
          </div>
          <!-- codigo scroll -->
          <div class="" id="listamangas">
            <?php require_once "real/manga.php"; ?>
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
                <center><h4>Subir página</h4></center>
              </div>

              <div class="modal-body"><!--#Body modal comentar-->
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="manga">Manga:</label>
                      <input type="text" class="form-control" value="<?php echo $querymanga['nombre'] ?>" placeholder="Manga" id="manga" name="manga" required="" readonly="">
                  </div>  
                  <div class="form-group">
                    <label for="cap">Capitulo:</label>
                      <input type="text" class="form-control" value="<?php echo $querycap['nombre']." - Nro. ".$idcap ?>" placeholder="Capitulo" id="cap" name="cap" required="" readonly="">
                  </div>     
                  <div class="form-group">
                    <label for="pag">Página:</label>
                      <input type="number" class="form-control" placeholder="Página" id="pag" name="pag" required="">
                  </div>        
                  <div class="form-group">
                    <label for="img">Archivo:</label>
                      <input type="file" class="form-control" id="img" name="img" required="">
                  </div>        
                  <div class="form-group">
                    <center>
                      <button type="submit" class="btn btn-success" id="btnsubir" name="btnsubir">Subir página</button>
                    </center>
                  </div>                                 
                </form>

                <?php
                if(isset($_POST['btnsubir'])){
                  $pag = mysqli_real_escape_string($conexion, $_POST['pag']);

                  $type = 'jpg';
                  $rfoto = $_FILES['img']['tmp_name'];
                  $carpeta = str_replace(" ", "", $querymanga['nombre']);
                  $name = $carpeta."-Cap".$idcap."-Pag".$pag.".".$type;

                  $img_destino = "mangas/".$carpeta."/".$idcap."/".$name;
                  $img_nombre = $name;

                  $subir_query = "INSERT INTO pagina (cap,id_manga,img,pag) values ('$idcap','$idmanga','$img_nombre','$pag')";
                  $subir_result = $conexion->query($subir_query);

                  if ($subir_result) {
                    if(is_uploaded_file($rfoto)){
                      mkdir("mangas/".$carpeta."/".$idcap, 0777, true);
                      copy($rfoto, $img_destino);
                      ?>
                      <input type="hidden" id="idmangar" value="<?php echo $idmanga ?>">
                      <input type="hidden" id="idcapr" value="<?php echo $idcap ?>">
                      <script>
                        console.log('Pagina Subida');
                        //location.href = 'mangas.php';
                        var idmanga = document.getElementById('idmangar').value;
                        var idcap = document.getElementById('idcapr').value;
                        window.location.replace('capitulo.php?manga='+idmanga+'&cap='+idcap);
                      </script>
                      <?php  
                    }else{
                        ?>
                        <script>console.log('Error al subir el archivo');</script>
                        <?php                        
                    }                    
                  }else{
                      ?>
                      <script>console.log('Error al subir la pagina');</script>
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
<!-- SCRIPT PARA CARGAR COMENTARIOS EN TIEMPO REAL -->
<script src="real/cargarmuro.js"></script>
<!-- LIGHT BOX PARA LAS FOTOGRAFIAS -->
<script type="text/javascript" src="dist/js/lightbox.js"></script>
</body>
</html>
