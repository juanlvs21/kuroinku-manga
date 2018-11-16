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

    $idmanga = mysqli_real_escape_string($conexion, $_GET['id']);
    $querymanga = ($conexion->query("SELECT * FROM manga WHERE id='$idmanga'"))->fetch_assoc();
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
  <!-- Archivos modificar el input file -->
  <link rel="stylesheet" type="text/css" href="dist/css/component.css" />
  <!-- ESTILO COMENTARIOS -->
  <link rel="stylesheet" type="text/css" href="dist/css/comentario.css" />
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
                  Subir capitulo
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

                <i class="fa fa-send"></i>

                <h3 class="box-title">
                  Estado
                </h3>
              </div>
              <div class="box-body">
                <center>
                  <form action="" method="post">
                    <input type="hidden" value="<?php echo $idmanga ?>" id="idm">
                    <div class="form-group">
                      <?php 
                      $queryestado = $conexion->query("SELECT estado FROM manga WHERE id='$idmanga'");
                      $rowestado = $queryestado->fetch_assoc();
                      ?>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6">
                        <select class="form-control" name="estado" id="estado" required="" >
                          <?php 
                          if ($rowestado['estado'] == 'Finalizado') {
                            ?>
                            <option value="Finalizado">Finalizado</option>
                            <option value="En curso">En curso</option>
                            <?php
                          }
                          if ($rowestado['estado'] == 'En curso') {
                            ?>
                            <option value="En curso">En curso</option>
                            <option value="Finalizado">Finalizado</option>
                            <?php
                          }
                          ?>
                        </select> 
                      </div>     
                      <button type="submit" class="btn btn-success col-md-6" onclick="estado()" name="btnestado">Actualizar</button>         
                    </div>
                  </form>
                  <?php 
                  if (isset($_POST['btnestado'])) {
                     $publicar = mysqli_real_escape_string($conexion, $_POST['estado']);
                     $querypublicarm = $conexion->query("UPDATE manga SET estado='$publicar' WHERE id='$idmanga'");

                     if ($querypublicarm) {
                       ?>
                        <script>
                          console.log('Estado manga actualizado - Código = 1');
                          var id = document.getElementById('idm').value;
                          window.location.replace('manga.php?id='+id);
                        </script>
                       <?php
                       exit;
                     }else{
                       ?>
                        <script>console.log('Estado manga no actualizado - Código = 0');</script>
                       <?php                    
                     }
                  }
                  ?>
                </center>
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

                <i class="fa fa-send"></i>

                <h3 class="box-title">
                  Publicar manga
                </h3>
              </div>
              <div class="box-body">
                <center>
                  <form action="" method="post">
                    <div class="form-group">
                      <?php 
                      if ($querymanga['publicado'] == 0) {
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
                    <div class="form-group">
                      <div class="col-md-6">
                        <select class="form-control" name="publicar" id="publicar" required="">
                          <option value="">Elija una opción</option>
                          <option value="1">Si</option>
                          <option value="0">No</option>
                        </select> 
                      </div>     
                      <button type="submit" class="btn btn-success col-md-6" onclick="publicarm()" name="btnpublicar">Publicar</button>         
                    </div>
                  </form>
                  <?php 
                  if (isset($_POST['btnpublicar'])) {
                     $publicar = mysqli_real_escape_string($conexion, $_POST['publicar']);
                     $querypublicarm = $conexion->query("UPDATE manga SET publicado='$publicar' WHERE id='$idmanga'");

                     if ($querypublicarm) {
                       ?>
                        <script>
                          console.log('Manga publicado - Código = 1');
                          var id = document.getElementById('idm').value;
                          window.location.replace('manga.php?id='+id);
                        </script>
                       <?php
                       exit;
                     }else{
                       ?>
                        <script>console.log('Manga no publicado - Código = 0');</script>
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
          <!-- codigo scroll -->
          <div class="box box-footer">
            <div class="box-title">
              <center>
                <h1><?php echo $querymanga['nombre'] ?></h1>
              </center>
            </div>
            <div class="box-body">
              <center>
                <p><?php echo "Género: ".$querymanga['genero']."  |  Temporada: ".$querymanga['temporada']."  |  Estado: ".$querymanga['estado']."  |  Creador: ".$querymanga['creador']."  |  Fecha de publicacion: ".$querymanga['fecha_pub'] ?></p>
              </center>
            </div>
          </div>         
          <div class="" id="listamangas">
            <?php require_once "real/cargarcapitulo.php"; ?>
          </div>

          <!-- OPINIONES -->
          <div class="panel-body box box-footer">
              <center>
                <h3>Opiniones</h3>
              </center>
              <hr style="color: #0056b2;" />
              <center><a href="#" class="btn btn-danger btn-sm btn-block" style="width: 200px" role="button" data-toggle="modal" data-target="#modalopinar"><span class="fa fa-pencil"></span> Opinar</a></center>
              <br>
              <ul class="list-group">
                  <?php
                  $queryopinion = "SELECT * FROM opinion WHERE id_manga = '$idmanga' AND desactivada='0' ORDER BY fecha DESC";
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
                                    <div class="mic-info">
                                        <?php 
                                        if ($opi['puntuacion'] == 1) {
                                          ?>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-white"></i>
                                          <i class="fa fa-star text-white"></i>
                                          <i class="fa fa-star text-white"></i>
                                          <i class="fa fa-star text-white"></i>
                                          <?php
                                        }
                                        if ($opi['puntuacion'] == 2) {
                                          ?>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-white"></i>
                                          <i class="fa fa-star text-white"></i>
                                          <i class="fa fa-star text-white"></i>
                                          <?php
                                        }
                                        if ($opi['puntuacion'] == 3) {
                                          ?>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-white"></i>
                                          <i class="fa fa-star text-white"></i>
                                          <?php
                                        }
                                        if ($opi['puntuacion'] == 4) {
                                          ?>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-white"></i>
                                          <?php
                                        }
                                        if ($opi['puntuacion'] == 5) {
                                          ?>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-yellow"></i>
                                          <i class="fa fa-star text-yellow"></i>
                                          <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="comment-text">
                                    <?php echo $opi['opinion'] ?>
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
                <center><h4><?php echo $querymanga['nombre'] ?> <small> Subir Capitulo</small></h4></center>
              </div>

              <div class="modal-body"><!--#Body modal comentar-->
                <form action="" method="post">
                  <div class="form-group">
                    <label for="cap">Capitulo:</label>
                      <input type="number" class="form-control" placeholder="Capitulo" id="cap" name="cap" required="">
                  </div>   
                  <div class="form-group">
                    <label for="nombre">Nombre:</label>
                      <input type="text" class="form-control" placeholder="Nombre" id="nombre" name="nombre" required="">
                  </div> 
                  <div class="form-group">
                    <label for="creditos">Creditos:</label>
                      <input type="text" class="form-control" placeholder="Creditos" id="creditos" name="creditos">
                  </div> 
                  <div class="form-group">
                    <label for="url">URL Página Creditos:</label>
                      <input type="text" class="form-control" placeholder="URL Página Creditos" id="url" name="url">
                  </div>       
                  <div class="form-group">
                    <center>
                      <button type="submit" class="btn btn-success" id="btnsubir" name="btnsubir">Subir capitulo</button>
                    </center>
                  </div>                                 
                </form>
                <?php
                if(isset($_POST['btnsubir'])){
                  $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
                  $cap = mysqli_real_escape_string($conexion, $_POST['cap']);
                  $creditos = mysqli_real_escape_string($conexion, $_POST['creditos']);
                  $url = mysqli_real_escape_string($conexion, $_POST['url']);

                  $subir_query = "INSERT INTO capitulo (cap,nombre, id_manga,fecha_sub,publicado,creditos,url_creditos) values ('$cap','$nombre','$idmanga',now(), '0', '$creditos', '$url')";
                  $subir_result = $conexion->query($subir_query);
                  if ($subir_result) {
                      ?>
                    <script>
                      console.log('Capitulo subido');
                      location.reload(true);
                    </script>
                    <?php                      
                  }else{
                    ?>
                    <script>console.log('Error al subir capitulo');</script>
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

  <!--MODAL OPINAR -->
      <div class="modal fade" id="modalopinar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!-- si quitas data-dismiss="modal" no se cierra el modal con un alert-->
                <center><h4>Opinión</h4></center>
              </div>
              <div class="modal-body"><!--#Body modal-->
                <script>
                  function encima1(){
                    $('#star1').removeClass('text-white');
                    $('#star1').addClass('text-yellow');
                  }      
                  function encima2(){
                    $('#star1').removeClass('text-white');
                    $('#star1').addClass('text-yellow');
                    $('#star2').removeClass('text-white');
                    $('#star2').addClass('text-yellow');
                  }
                  function encima3(){
                    $('#star1').removeClass('text-white');
                    $('#star1').addClass('text-yellow');
                    $('#star2').removeClass('text-white');
                    $('#star2').addClass('text-yellow');
                    $('#star3').removeClass('text-white');
                    $('#star3').addClass('text-yellow');
                  }  
                  function encima4(){
                    $('#star1').removeClass('text-white');
                    $('#star1').addClass('text-yellow');
                    $('#star2').removeClass('text-white');
                    $('#star2').addClass('text-yellow');
                    $('#star3').removeClass('text-white');
                    $('#star3').addClass('text-yellow');
                    $('#star4').removeClass('text-white');
                    $('#star4').addClass('text-yellow');
                  }   
                  function encima5(){
                    $('#star1').removeClass('text-white');
                    $('#star1').addClass('text-yellow');
                    $('#star2').removeClass('text-white');
                    $('#star2').addClass('text-yellow');
                    $('#star3').removeClass('text-white');
                    $('#star3').addClass('text-yellow');
                    $('#star4').removeClass('text-white');
                    $('#star4').addClass('text-yellow');
                    $('#star5').removeClass('text-white');
                    $('#star5').addClass('text-yellow');
                  }
                  function noencima(){
                    var click = document.getElementById('activarclick').value;
                    if (click == 1) {
                      $('#star2').removeClass('text-yellow');
                      $('#star2').addClass('text-white');
                      $('#star3').removeClass('text-yellow');
                      $('#star3').addClass('text-white');
                      $('#star4').removeClass('text-yellow');
                      $('#star4').addClass('text-white');   
                      $('#star5').removeClass('text-yellow');
                      $('#star5').addClass('text-white');                   
                    }
                    if (click == 2) {
                      $('#star3').removeClass('text-yellow');
                      $('#star3').addClass('text-white');
                      $('#star4').removeClass('text-yellow');
                      $('#star4').addClass('text-white');   
                      $('#star5').removeClass('text-yellow');
                      $('#star5').addClass('text-white');                   
                    }
                    if (click == 3) {
                      $('#star4').removeClass('text-yellow');
                      $('#star4').addClass('text-white');   
                      $('#star5').removeClass('text-yellow');
                      $('#star5').addClass('text-white');                   
                    }                    
                    if (click == 4) {  
                      $('#star5').removeClass('text-yellow');
                      $('#star5').addClass('text-white');                   
                    }
                  }                  
                  function puntuar1(){
                    document.getElementById('activarclick').value = "1";
                    $('#star1').removeClass('text-white');
                    $('#star1').addClass('text-yellow');
                  }
                  function puntuar2(){
                    document.getElementById('activarclick').value = "2";
                    $('#star1').removeClass('text-white');
                    $('#star1').addClass('text-yellow');
                    $('#star2').removeClass('text-white');
                    $('#star2').addClass('text-yellow');
                  }
                   
                  function puntuar3(){
                    document.getElementById('activarclick').value = "3";
                    $('#star1').removeClass('text-white');
                    $('#star1').addClass('text-yellow');
                    $('#star2').removeClass('text-white');
                    $('#star2').addClass('text-yellow');
                    $('#star3').removeClass('text-white');
                    $('#star3').addClass('text-yellow');
                  }
                  function puntuar4(){
                    document.getElementById('activarclick').value = "4";
                    $('#star1').removeClass('text-white');
                    $('#star1').addClass('text-yellow');
                    $('#star2').removeClass('text-white');
                    $('#star2').addClass('text-yellow');
                    $('#star3').removeClass('text-white');
                    $('#star3').addClass('text-yellow');
                  }
                  function puntuar5(){
                    document.getElementById('activarclick').value = "5";
                    $('#star1').removeClass('text-white');
                    $('#star1').addClass('text-yellow');
                    $('#star2').removeClass('text-white');
                    $('#star2').addClass('text-yellow');
                    $('#star3').removeClass('text-white');
                    $('#star3').addClass('text-yellow');
                    $('#star4').removeClass('text-white');
                    $('#star4').addClass('text-yellow');
                    $('#star5').removeClass('text-white');
                    $('#star5').addClass('text-yellow');
                  }                      
                </script>
                <script>
                  function encima1n(){
                    $('#star1n').removeClass('text-white');
                    $('#star1n').addClass('text-yellow');
                  }      
                  function encima2n(){
                    $('#star1n').removeClass('text-white');
                    $('#star1n').addClass('text-yellow');
                    $('#star2n').removeClass('text-white');
                    $('#star2n').addClass('text-yellow');
                  }
                  function encima3n(){
                    $('#star1n').removeClass('text-white');
                    $('#star1n').addClass('text-yellow');
                    $('#star2n').removeClass('text-white');
                    $('#star2n').addClass('text-yellow');
                    $('#star3n').removeClass('text-white');
                    $('#star3n').addClass('text-yellow');
                  }  
                  function encima4n(){
                    $('#star1n').removeClass('text-white');
                    $('#star1n').addClass('text-yellow');
                    $('#star2n').removeClass('text-white');
                    $('#star2n').addClass('text-yellow');
                    $('#star3n').removeClass('text-white');
                    $('#star3n').addClass('text-yellow');
                    $('#star4n').removeClass('text-white');
                    $('#star4n').addClass('text-yellow');
                  }   
                  function encima5n(){
                    $('#star1n').removeClass('text-white');
                    $('#star1n').addClass('text-yellow');
                    $('#star2n').removeClass('text-white');
                    $('#star2n').addClass('text-yellow');
                    $('#star3n').removeClass('text-white');
                    $('#star3n').addClass('text-yellow');
                    $('#star4n').removeClass('text-white');
                    $('#star4n').addClass('text-yellow');
                    $('#star5n').removeClass('text-white');
                    $('#star5n').addClass('text-yellow');
                  }
                  function noenciman(){
                    var click2 = document.getElementById('activarclick2').value;
                    if (click2 == 1) {
                      $('#star2n').removeClass('text-yellow');
                      $('#star2n').addClass('text-white');
                      $('#star3n').removeClass('text-yellow');
                      $('#star3n').addClass('text-white');
                      $('#star4n').removeClass('text-yellow');
                      $('#star4n').addClass('text-white');   
                      $('#star5n').removeClass('text-yellow');
                      $('#star5n').addClass('text-white');                   
                    }
                    if (click2 == 2) {
                      $('#star3n').removeClass('text-yellow');
                      $('#star3n').addClass('text-white');
                      $('#star4n').removeClass('text-yellow');
                      $('#star4n').addClass('text-white');   
                      $('#star5n').removeClass('text-yellow');
                      $('#star5n').addClass('text-white');                   
                    }
                    if (click2 == 3) {
                      $('#star4n').removeClass('text-yellow');
                      $('#star4n').addClass('text-white');   
                      $('#star5n').removeClass('text-yellow');
                      $('#star5n').addClass('text-white');                   
                    }                    
                    if (click2 == 4) {  
                      $('#star5n').removeClass('text-yellow');
                      $('#star5n').addClass('text-white');                   
                    }
                  }                  
                  function puntuar1n(){
                    document.getElementById('activarclick2').value = "1";
                    $('#star1n').removeClass('text-white');
                    $('#star1n').addClass('text-yellow');
                  }
                  function puntuar2n(){
                    document.getElementById('activarclick2').value = "2";
                    $('#star1n').removeClass('text-white');
                    $('#star1n').addClass('text-yellow');
                    $('#star2n').removeClass('text-white');
                    $('#star2n').addClass('text-yellow');
                  }
                   
                  function puntuar3n(){
                    document.getElementById('activarclick2').value = "3";
                    $('#star1n').removeClass('text-white');
                    $('#star1n').addClass('text-yellow');
                    $('#star2n').removeClass('text-white');
                    $('#star2n').addClass('text-yellow');
                    $('#star3n').removeClass('text-white');
                    $('#star3n').addClass('text-yellow');
                  }
                  function puntuar4n(){
                    document.getElementById('activarclick2').value = "4";
                    $('#star1n').removeClass('text-white');
                    $('#star1n').addClass('text-yellow');
                    $('#star2n').removeClass('text-white');
                    $('#star2n').addClass('text-yellow');
                    $('#star3n').removeClass('text-white');
                    $('#star3n').addClass('text-yellow');
                  }
                  function puntuar5n(){
                    document.getElementById('activarclick2n').value = "5";
                    $('#star1n').removeClass('text-white');
                    $('#star1n').addClass('text-yellow');
                    $('#star2n').removeClass('text-white');
                    $('#star2n').addClass('text-yellow');
                    $('#star3n').removeClass('text-white');
                    $('#star3n').addClass('text-yellow');
                    $('#star4n').removeClass('text-white');
                    $('#star4n').addClass('text-yellow');
                    $('#star5n').removeClass('text-white');
                    $('#star5n').addClass('text-yellow');
                  }                      
                </script>

                <?php 
                $buscaropinion = $conexion->query("SELECT id,opinion,puntuacion FROM opinion WHERE id_usuario='$yo' AND id_manga='$idmanga' AND desactivada='0'");
                $resultbuscaropinion = $buscaropinion->fetch_assoc();
                $miopinion = $resultbuscaropinion['opinion'];
                $mipuntuacion = $resultbuscaropinion['puntuacion'];
                $idopinion = $resultbuscaropinion['id'];
                $verificaropinion = $buscaropinion->num_rows;
                
                if ($verificaropinion > 0) {
                  ?>
                  <div>
                    <center>
                      <p>
                        Puntuación
                        <?php 
                        if ($mipuntuacion == 1) {
                          ?>
                          <i class="fa fa-star text-yellow" id="star1" onmouseout="noencima()" onclick="puntuar1()" onmouseover="encima1()" ></i>
                          <i class="fa fa-star text-white" id="star2" onmouseout="noencima()" onclick="puntuar2()" onmouseover="encima2()" ></i>
                          <i class="fa fa-star text-white" id="star3" onmouseout="noencima()" onclick="puntuar3()" onmouseover="encima3()" ></i>
                          <i class="fa fa-star text-white" id="star4" onmouseout="noencima()" onclick="puntuar4()" onmouseover="encima4()" ></i>
                          <i class="fa fa-star text-white" id="star5" onmouseout="noencima()" onclick="puntuar5()" onmouseover="encima5()" ></i>
                        <?php
                        }
                        ?>
                        <?php 
                        if ($mipuntuacion == 2) {
                          ?>
                          <i class="fa fa-star text-yellow" id="star1" onmouseout="noencima()" onclick="puntuar1()" onmouseover="encima1()" ></i>
                          <i class="fa fa-star text-yellow" id="star2" onmouseout="noencima()" onclick="puntuar2()" onmouseover="encima2()" ></i>
                          <i class="fa fa-star text-white" id="star3" onmouseout="noencima()" onclick="puntuar3()" onmouseover="encima3()" ></i>
                          <i class="fa fa-star text-white" id="star4" onmouseout="noencima()" onclick="puntuar4()" onmouseover="encima4()" ></i>
                          <i class="fa fa-star text-white" id="star5" onmouseout="noencima()" onclick="puntuar5()" onmouseover="encima5()" ></i>
                        <?php
                        }
                        ?>
                        <?php 
                        if ($mipuntuacion == 3) {
                          ?>
                          <i class="fa fa-star text-yellow" id="star1" onmouseout="noencima()" onclick="puntuar1()" onmouseover="encima1()" ></i>
                          <i class="fa fa-star text-yellow" id="star2" onmouseout="noencima()" onclick="puntuar2()" onmouseover="encima2()" ></i>
                          <i class="fa fa-star text-yellow" id="star3" onmouseout="noencima()" onclick="puntuar3()" onmouseover="encima3()" ></i>
                          <i class="fa fa-star text-white" id="star4" onmouseout="noencima()" onclick="puntuar4()" onmouseover="encima4()" ></i>
                          <i class="fa fa-star text-white" id="star5" onmouseout="noencima()" onclick="puntuar5()" onmouseover="encima5()" ></i>
                        <?php
                        }
                        ?>
                        <?php 
                        if ($mipuntuacion == 4) {
                          ?>
                          <i class="fa fa-star text-yellow" id="star1" onmouseout="noencima()" onclick="puntuar1()" onmouseover="encima1()" ></i>
                          <i class="fa fa-star text-yellow" id="star2" onmouseout="noencima()" onclick="puntuar2()" onmouseover="encima2()" ></i>
                          <i class="fa fa-star text-yellow" id="star3" onmouseout="noencima()" onclick="puntuar3()" onmouseover="encima3()" ></i>
                          <i class="fa fa-star text-yellow" id="star4" onmouseout="noencima()" onclick="puntuar4()" onmouseover="encima4()" ></i>
                          <i class="fa fa-star text-white" id="star5" onmouseout="noencima()" onclick="puntuar5()" onmouseover="encima5()" ></i>
                        <?php
                        }
                        ?>
                        <?php 
                        if ($mipuntuacion == 5) {
                          ?>
                          <i class="fa fa-star text-yellow" id="star1" onmouseout="noencima()" onclick="puntuar1()" onmouseover="encima1()" ></i>
                          <i class="fa fa-star text-yellow" id="star2" onmouseout="noencima()" onclick="puntuar2()" onmouseover="encima2()" ></i>
                          <i class="fa fa-star text-yellow" id="star3" onmouseout="noencima()" onclick="puntuar3()" onmouseover="encima3()" ></i>
                          <i class="fa fa-star text-yellow" id="star4" onmouseout="noencima()" onclick="puntuar4()" onmouseover="encima4()" ></i>
                          <i class="fa fa-star text-yellow" id="star5" onmouseout="noencima()" onclick="puntuar5()" onmouseover="encima5()" ></i>
                        <?php
                        }
                        ?>
                      </p>
                    </center>
                  </div>
                  <form action="" method="post">
                    <input type="hidden" id="activarclick" name="puntuacion" value="<?php echo $mipuntuacion ?>">
                    <input type="hidden" id="idmangaopinar" name="idmangaopinar" value="<?php echo $idmanga ?>">
                    <div class="form-group">
                      <textarea type="text" class="form-control" id="miopinion" name="miopinion" placeholder="Escriba su opinion..." required><?php echo $miopinion ?></textarea>
                      <center>
                        <small style="color:red">Usted ya ha realizado una opinion anteriormente, si desea puede actualizarla</small>
                        <br>
                        <img src="dist/img/loadingcoment.gif" class="hidden" id="loadingopinion" alt="" width="100" height="60">
                      </center>
                    </div>    
                    <div class="form-group">
                      <center>
                        <button type="submit" class="btn btn-primary" id="btnopinar"  name="btnopinar">Publicar</button>
                      </center>
                    </div>                  
                  </form> 
                  <?php 
                  if (isset($_POST['btnopinar'])) {
                    $opinion = mysqli_real_escape_string($conexion, $_POST['miopinion']);
                    $puntuacion = mysqli_real_escape_string($conexion, $_POST['puntuacion']);

                    $querydesactivar = $conexion->query("UPDATE opinion SET desactivada='1' WHERE id='$idopinion'");
                    if ($querydesactivar) {
                      $query = $conexion->query("INSERT INTO opinion (id_usuario,id_manga,opinion,puntuacion,fecha) VALUES ('$yo','$idmanga','$opinion','$puntuacion',now())");

                      if ($query) {
                        ?>
                        <script>
                          console.log('Manga publicado - Código = 1');
                          var id = document.getElementById('idmangaopinar').value;
                          window.location.replace('manga.php?id='+id);
                        </script>
                        <?php
                      }else{
                        ?>
                        <input type="hidden" id="error" value="<?php echo $conexion->error ?>">
                        <script>
                          var error = document.getElementById('error').value;
                          console.log(error);
                        </script>
                        <center> 
                          <p style="color:red">Error desconocido, intente más tarde</p>
                        </center>
                        <?php
                      }
                    }else{
                      ?>
                      <input type="hidden" id="errordesactopi" value="<?php echo $conexion->error ?>">
                      <script>
                        var error = document.getElementById('errordesactopi').value;
                        console.log('Error al desactivar opinion - '+error);
                      </script>
                      <?php
                    }
                  }
                }else{
                  ?>
                  <div>
                    <center>
                      <p>
                        Puntuación
                        <i class="fa fa-star text-white" id="star1n" onmouseout="noenciman()" onclick="puntuar1n()" onmouseover="encima1n()" ></i>
                        <i class="fa fa-star text-white" id="star2n" onmouseout="noenciman()" onclick="puntuar2n()" onmouseover="encima2n()" ></i>
                        <i class="fa fa-star text-white" id="star3n" onmouseout="noenciman()" onclick="puntuar3n()" onmouseover="encima3n()" ></i>
                        <i class="fa fa-star text-white" id="star4n" onmouseout="noenciman()" onclick="puntuar4n()" onmouseover="encima4n()" ></i>
                        <i class="fa fa-star text-white" id="star5n" onmouseout="noenciman()" onclick="puntuar5n()" onmouseover="encima5n()" ></i>
                      </p>
                    </center>
                  </div>
                  <form action="" method="post">
                    <input type="hidden" id="activarclick2" name="puntuacion2" value="0">
                    <input type="hidden" id="idmangaopinar2" name="idmangaopinar2" value="<?php echo $idmanga ?>">
                    <div class="form-group">
                      <textarea type="text" class="form-control" id="miopinion2" name="miopinion2" placeholder="Escriba su opinion..." required ></textarea>
                      <center><img src="dist/img/loadingcoment.gif" class="hidden" id="loadingopinion2" alt="" width="100" height="60"></center>
                    </div>    
                    <div class="form-group">
                      <center><button type="button" class="btn btn-primary" id="btnopinar2"  name="btnopinar2">Publicar</button></center>
                    </div>                  
                  </form>  
                  <?php 
                  if (isset($_POST['btnopinar2'])) {
                    $opinion2 = mysqli_real_escape_string($conexion, $_POST['miopinion2']);
                    $puntuacion2 = mysqli_real_escape_string($conexion, $_POST['puntuacion2']);

                    $query = $conexion->query("INSERT INTO opinion (id_usuario,id_manga,opinion,puntuacion,fecha) VALUES ('$yo','$idmanga','$opinion2','$puntuacion2',now())");

                    if ($query) {
                        ?>
                        <script>
                          console.log('Manga publicado - Código = 1');
                          var id = document.getElementById('idmangaopinar2').value;
                          window.location.replace('manga.php?id='+id);
                        </script>
                        <?php
                    }else{
                      ?>
                      <input type="hidden" id="error2" value="<?php echo $conexion->error ?>">
                      <script>
                        var error2 = document.getElementById('error2').value;
                        console.log(error2);
                      </script>
                      <center> 
                        <p style="color:red">Error desconocido, intente más tarde</p>
                      </center>
                      <?php
                    }
                  }
                  ?>
                  <?php                  
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
  <!-- FIN MODAL OPINAR -->  
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
<!-- SCRIPT PARA CARGAR NUMERO MENSAJES SIDEBAR EN TIEMPO REAL -->
<script src="real/bnm-sidebar.js"></script>
<!-- SCRIPT PARA CARGAR NUMERO MENSAJES HEADER EN TIEMPO REAL -->
<script src="real/bnm-header.js"></script>
<!-- SCRIPT PARA CARGAR NUMERO NOTIFICACIONES EN TIEMPO REAL -->
<script src="real/bnnotifi.js"></script>

<script>
  $('#btnopinar').click(function(){

    $('#btnopinar').addClass('disabled');
    $('#loadingopinion').removeClass('hidden');

    var opinion = document.getElementById('miopinion').value;
    var puntuacion = document.getElementById('activarclick').value;
    var manga = document.getElementById('idmangaopinar').value;
    var idopinion = document.getElementById('idopinion').value;

    var datos = 'opinion='+opinion;
    datos += '&puntuacion='+puntuacion;
    datos += '&manga='+manga;
    datos += '&idopinion='+idopinion;

    $.ajax({
        type: "POST",
        url: "real/volveropinar.php",
        data: datos,
        dataType:"html",
        asycn:false,
        success: function(){
          console.log('Datos enviados para opinar');
        }
    })
    .done(function(respuesta2){
        console.log('Consulta realizada opinion');
        $("#resultopinar").html(respuesta2);
        $('#btnopinar').removeClass('disabled');
        $('#loadingopinion').addClass('hidden');        
    })
    .fail(function(respuesta2){
        console.log('Error al opinar');
        $('#btnopinar').removeClass('disabled');
        $('#loadingopinion').addClass('hidden');  
    })     
  });

  $('#btnopinar2').click(function(){

    $('#btnopinar2').addClass('disabled');
    $('#loadingopinion2').removeClass('hidden');

    var opinion = document.getElementById('miopinion2').value;
    var puntuacion = document.getElementById('activarclick2').value;
    var manga = document.getElementById('idmangaopinar2').value;

    var datos = 'opinion='+opinion;
    datos += '&puntuacion='+puntuacion;
    datos += '&manga='+manga;

    $.ajax({
        type: "POST",
        url: "real/opinar.php",
        data: datos,
        dataType:"html",
        asycn:false,
        success: function(){
          console.log('Datos enviados para opinar');
        }
    })
    .done(function(respuesta2){
        console.log('Consulta realizada opinion');
        $("#resultopinar2").html(respuesta2);
        $('#btnopinar2').removeClass('disabled');
        $('#loadingopinion2').addClass('hidden');        
    })
    .fail(function(respuesta2){
        console.log('Error al opinar');
        $('#btnopinar2').removeClass('disabled');
        $('#loadingopinion2').addClass('hidden');  
    })     
  });
</script>
</body>
</html>
