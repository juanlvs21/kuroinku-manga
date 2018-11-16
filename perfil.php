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
    $nombreapellido = $row['nombre']." ".$row['apellido'];


    $id = mysqli_real_escape_string($conexion,$_GET['id']);
    $queryget = "SELECT * FROM usuario WHERE id='$id'";
    $resultget = $conexion->query($queryget);
    $rowget = $resultget->fetch_assoc();
    $nombreapellido2 = $rowget['nombre']." ".$rowget['apellido'];

    $pag = $_GET['perfil'];

    $idnumperfilusu = mysqli_real_escape_string($conexion,$rowget['id']);

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
  <title>Kuroinku | <?php echo $rowget['nombre'] ?></title>
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
  <script>
    /*$(function(){
      $("#btnpersonal").click(function(){
        event.preventDefault();
        var nombre = document.getElementById("nombre").value;
        var apellido = document.getElementById("apellido").value;
        //var fecha_nac = document.getElementById("fecha_nac").value;
        var sexo = document.getElementById("sexo").value;
        var direccion = document.getElementById("direccion").value;
        var correo = document.getElementById("correo").value;

        var datosperfil = 'nombre='+nombre;
        datosperfil += '&apellido='+apellido;
        //datosperfil += '&fecha_nac='+fecha_nac;
        datosperfil += '&sexo='+sexo;
        datosperfil += '&direccion='+direccion;
        datosperfil += '&correo='+correo;

        $.ajax({
            type: "POST",
            url: "actualizarpersonal.php",
            data: datosperfil,
            dataType:"html",
            asycn:false,
            success: function(){
              console.log('Datos enviados');
              alert('Datos personales actualizados satisfactoriamente');
            }
        })
        .done(function(respuesta2){
            console.log('Consulta Realizada');
        })
        .fail(function(respuesta2){
            console.log('error');
        })
      });
    });*/
  </script>
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

  <!-- SCRIPT PARA IMPEDIR ETIQUETAS EN LAS PUBLICACIONES -->
  <script type="text/javascript">
    function validarn(e){
      tecla = (document.all) ? e.keyCode : e.which;
      if(tecla == 8) return true;
      if(tecla == 9) return true;
      if(tecla == 11) return true;

      patron = /[A-Za-zñ¡!#$%&()=?¿¡*;:+0-9-_'.,<^ ]/;

      te = String.fromCharCode(tecla);

      return patron.test(te);
    }
  </script>
  <!-- /FIN SCRIPT PARA IMPEDIR ETIQUETAS EN LAS PUBLICACIONES -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">
        <section class="col-lg-4">

          <!-- Map box -->
          <div class="box box-danger">
            <!--div class="box-header"-->
              <!-- tools box -->
              <!--div class="pull-right box-tools"-->
                <!--button type="button" class="btn btn-danger btn-sm daterange pull-right" data-toggle="tooltip"
                        title="Date range">
                  <i class="fa fa-calendar"></i></button-->
                <!--button type="button" class="btn btn-danger btn-sm pull-right" data-widget="collapse"
                        data-toggle="tooltip" title="Minimizar" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div-->
              <!-- /. tools -->

            <!--/div-->

            <div class="box-body box-profile">
              <!--div id="world-map" style="height: 250px; width: 100%;"></div-->

              <center>
                <div class="image">                  
                  <a data-lightbox="roadtrip" data-title="<a href='perfil.php?id=<?php echo $id;?>&perfil=publicacionesp' style='color: red;'><?php echo $nombreapellido2;?></a> <br> Foto de Perfil" href="avatar/<?php echo $rowget['foto'];?>">
                  <img src="avatar/<?php echo $rowget['foto'] ?>" class="img-circle" alt="User Image" width="180" height="180">
                  </a> 
                  <?php
                  if ($row['id'] == $rowget['id']) { ?>
                    <a class="fa fa-camera" href="" style="color: black; position:absolute;" data-toggle="modal" data-target="#modalfotoperfil"></a>
                  <?php
                  }
                  ?>
                </div>

                <?php
                if($rowget['verificado'] != 0) {?>
                  <center><h3 class="profile-username text-center"><?php echo $rowget['nombre']." ".$rowget['apellido']." ";?><img src="dist/img/verificada2.png" alt="" width="20" height="20"></h3></center>
                <?php
                }else { ?>
                  <center><h3 class="profile-username text-center"><?php echo $rowget['nombre']." ".$rowget['apellido'];?></h3></center>
                <?php
                }

                if ($rowget['editor'] == 1) { ?>
                  <center><h4 class="description text-center"><i style="color: green;"> Editor<a class="fa fa-pencil" style="  color: green;"></a></i></h4></center>
                <?php
                }
                if ($rowget['admin'] == 1) { ?>
                  <center><h4 class="description text-center"><i style="color: blue;"> Administrador<a class="fa fa-star" style="  color: blue;"></a></i></h4></center>
                <?php
                }

                if ($row['id'] != $rowget['id']) {
                  $idmiperfil = mysqli_real_escape_string($conexion,$row['id']);
                  $idperfilusu = mysqli_real_escape_string($conexion,$rowget['id']);
                  $queryseguidor = "SELECT * FROM seguidores WHERE seguidor='$idmiperfil' AND seguido='$idperfilusu'";
                  $resultseguidor = $conexion->query($queryseguidor);
                  $rowseguidor = $resultseguidor->fetch_assoc();

                  $queryseguido = "SELECT * FROM seguidores WHERE seguidor='$idperfilusu' AND seguido='$idmiperfil'";
                  $resultseguido = $conexion->query($queryseguido);
                  $rowseguido = $resultseguido->fetch_assoc();

                  if($rowseguidor){ ?>
                    <br>
                    <form action="" method="post">
                      <button type="submit" class="btn btn-default btn-sm" name="btndejarseguir">Dejar de Seguir</button>
                      <?php
                      if ($rowseguido) {?>
                        <button type="submit" name="btntesigue" class="btn btn-danger btn-sm disabled">Te sigue</button>
                      <?php
                      } ?>
                    </form>
                  <?php
                  }else{ ?>
                    <br>
                    <form action="" method="post">
                      <button type="submit" class="btn btn-danger btn-sm" id="btnseguir" name="btnseguir">Seguir</button>
                      <?php
                      if ($rowseguido) {?>
                        <button type="submit" name="btntesigue" class="btn btn-danger btn-sm disabled">Te sigue</button>
                      <?php
                      } ?>
                    </form>
                  <?php
                  }

                  if(isset($_POST['btnseguir'])){
                    $queryseguir = "INSERT INTO seguidores (seguidor,seguido,fecha_reg) VALUES ('$idmiperfil','$idperfilusu',now())";
                    $resultseguir = $conexion->query($queryseguir);

                    $seguirnotifi = $conexion->query("INSERT INTO notificacion (user1,user2,tipo,id_noti,fecha) VALUES('$idperfilusu','$idmiperfil',1,'$idperfilusu',now())");

                    if ($seguirnotifi) {
                      ?>
                      <script>console.log('Notificacion de seguimiento agregada')</script>
                      <?
                    }else{
                      ?>
                      <input type="hidden" id="errornoti" value="<?php echo $conexion->error ?>">
                      <script>
                        var errornoti = document.getElementById('errornoti').value;
                        console.log(errornoti);
                      </script>
                      <?php
                    }
                    ?>
                    <script type="text/javascript">
                        location.href = 'perfil.php?id=<?php echo $idperfilusu;?>&perfil=publicacionesp';
                    </script>
                    <?php
                  }
                  if(isset($_POST['btndejarseguir'])){
                    $querydejarseguir = "DELETE FROM seguidores WHERE seguidor='$idmiperfil' AND seguido='$idperfilusu'";
                    $resultdejarseguir = $conexion->query($querydejarseguir);
                    ?>
                    <script type="text/javascript">
                        location.href = 'perfil.php?id=<?php echo $idperfilusu;?>&perfil=publicacionesp';
                    </script>
                    <?php
                  }

                }

                if ($rowget['id'] != $yo) { ?>
                  <br>
                  <a href="chat.php?usuario=<?php echo $rowget['id']; ?>&leido=1" class="btn btn-primary btn-sm">Enviar Mensaje</a>
                <?php
                }
                ?>
              </center>

              <br>

              <ul class="list-group list-group-unbordered col-lg-10 col-lg-offset-1">
                <li class="list-group-item">
                  <a style="color: black; cursor: pointer;" data-toggle="modal" data-target="#modalseguidores"><b>Seguidores</b></a><a class="pull-right" href="" style="color: red;" data-toggle="modal" data-target="#modalseguidores"><?php echo $numseguidores; ?></a>
                </li>
                <li class="list-group-item">
                  <a style="color: black; cursor: pointer;" data-toggle="modal" data-target="#modalseguidos"><b>Seguidos</b></a><a class="pull-right" href="" style="color: red;" data-toggle="modal" data-target="#modalseguidos"><?php echo $numseguidos; ?></a>
                </li>
                <li class="list-group-item">
                  <a style="color: black; cursor: pointer;" data-toggle="modal" data-target="#modalmangasf"><b>Mangas Favoritos</b></a><a class="pull-right" href="" style="color: red;" data-toggle="modal" data-target="#modalmangasf"><?php //echo $numseguidos; ?></a>
                </li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

          <!-- solid sales graph -->
          <div class="box box-solid box-profile box-danger">
            <div class="box-header">
              <i class="fa fa-address-card"></i>
              <h3 class="box-title">Información</h3>
            </div>
            <div class="box-body border-radius-none">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b><img src="dist/img/calendario.png"  width="20" height="20">Fecha Nacimiento</b> <a class="pull-right" style="color: red;" ><?php echo $rowget['fecha_nac']; ?></a>
                </li>
                  <li class="list-group-item">
                    <b><img src="dist/img/direccion.png"  width="20" height="20">Direccion</b> <a class="pull-right" style="color: red;" ><?php echo $rowget['direccion']; ?></a>
                  </li>
                <li class="list-group-item">
                  <b><img src="dist/img/facebook.png"  width="20" height="20">Fecebook</b> <a class="pull-right" style="color: red;"><?php echo $rowget['facebook']; ?></a>
                </li>
                <li class="list-group-item">
                  <b><img src="dist/img/twitter.png"  width="20" height="20">Twitter</b> <a class="pull-right" style="color: red;" ><?php echo $rowget['twitter']; ?></a>
                </li>
                <li class="list-group-item">
                  <b><img src="dist/img/instagram.png"  width="20" height="20">Instagram</b> <a class="pull-right" style="color: red;"><?php echo $rowget['instagram']; ?></a>
                </li>
              </ul>
              <!--div class="chart" id="line-chart" style="height: 250px;"></div-->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </section>
        <!-- right col -->

        <!-- Left col -->
        <section class="col-lg-8">
          <div class="nav-tabs">
            <ul class="nav nav-tabs" style="background: white">
              <li class="<?php echo $pag == 'publicacionesp' ? 'active' : ''; ?>"><a href="?id=<?php echo $id;?>&perfil=publicacionesp" style="color:black">Publicaciones</a></li>
              <!--li><a href="#fotos" data-togglen="tab">Fotografías </a></li-->
              <?php 
              if ($yo == $id) { ?>
                <li class="<?php echo $pag == 'editarperfil' ? 'active' : ''; ?>"><a href="?id=<?php echo $id;?>&perfil=editarperfil" style="color:black">Editar Perfil</a></li>
              <?php
              }
              ?>
            </ul>

            <div class="tab-conten">
                <!-- codigo scroll -->
                <div class="scroll">
                  <?php
                  $pagina = isset($_GET['perfil']) ? strtolower($_GET['perfil']) : 'publicacionesp';
                  require_once $pagina.'.php';
                  ?>
                </div>
                <script>
                  /*$(document).ready(function(){
                    $('scroll').jscroll({
                      loadingHtml:'<img src="dist/img/loading.gif" alt="Loading">';
                    });
                  });*/
                </script>
            </div>
          </div>
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>

  <!--MODAL FOTO PERFIL -->
      <div class="modal fade" id="modalfotoperfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!-- si quitas data-dismiss="modal" no se cierra el modal con un alert-->
                <center><h4>Cambiar foto de Perfil</h4></center>
              </div>

              <div class="modal-body"><!--#Body modal comentar-->
                <div class="box box-widget">
                  <center>
                    <form action="" method="post">
                      <input class="btn btn-danger" id="eliminarfoto" type="submit" name="btneliminarperfil" value="Eliminar Foto Actual">
                    </form>
                  </center>
                  <br>
                </div>
                <div class="box box-widget">
                  <center><h5>Subir Fotografia</h5></center>
                  <form class="" action="" method="post" enctype="multipart/form-data">
                    <center>
                      <input type="file" name="fotoperfil">
                      <br>
                      <small style="color: #969696">¡Advertencia! - Se recomienda el uso de imagenes cuadradas (1:1) para evitar deformación. <br> (El uso de recorte de imagen será integrado en próximas versiones)</small>
                      <br>
                      <br>
                      <input class="btn btn-success" type="submit" name="btnperfil" value="Subir">
                    </center>
                  </form>   
                  <br>
                </div>

                <?php
                if(isset($_POST['btneliminarperfil'])){
                    $queryeliminarfoto = $conexion->query("SELECT foto FROM usuario WHERE id='$yo'");
                    $roweliminarfoto = $queryeliminarfoto->fetch_assoc();
                    $eliminarfoto = $roweliminarfoto['foto']; 

                    if (is_file("avatar/".$eliminarfoto)){
                      $eliminarf_query = $conexion->query("UPDATE `usuario` SET `foto`='perfil.png' WHERE id='$yo'");
                      if ($eliminarf_query) {
                        if (unlink("avatar/".$eliminarfoto)){
                          ?>
                          <script type="text/javascript">
                              location.href = 'perfil.php?id=<?php echo $_GET['id'];?>&perfil=publicacionesp';
                          </script>
                          <?php
                        }else{
                          ?>
                          <script type="text/javascript">
                              alert('Error al eliminar la fotografia');
                          </script>
                          <?php                          
                        }
                      }else{
                        ?>
                        <script type="text/javascript">
                            alert('Error al actualizar los datos de la fotografia');
                        </script>
                        <?php  
                      }
                    }else{
                      ?>
                      <script type="text/javascript">
                          alert('Fotografia no encontrada');
                      </script>
                      <?php  
                    }           
                }

                if (isset($_POST['btnperfil'])) {
                  function validar($file){
                		return true;
              	  }

                	if (validar($_FILES)) {
                    $querybuscarfoto = $conexion->query("SELECT foto FROM usuario WHERE id='$yo'");
                    $rowbuscarfoto = $querybuscarfoto->fetch_assoc();
                    $buscarfoto = $rowbuscarfoto['foto'];
                    $rfoto2 = $_FILES['fotoperfil']['tmp_name'];

                    if ($querybuscarfoto) {
                      if (is_file("avatar/".$buscarfoto)) {
                        if ($buscarfoto == "perfil.png") {
                            if (validar($_FILES)) {
                              $queryr = "SHOW TABLE STATUS WHERE `Name` = 'publicaciones'";
                              $result = $conexion->query($queryr);
                              $data = $result->fetch_assoc();
                              $next_increment = $data['Auto_increment'];

                              $userpublic = $_SESSION['id'];
                              $fechanombreimg = date('Y-m-d');
                              $alea = $userpublic."-".$fechanombreimg."-".substr(strtoupper(md5(microtime(true))), 0,12);
                              $code = $next_increment.$alea;

                              $type = 'jpg';
                              $rfoto = $_FILES['fotoperfil']['tmp_name'];
                              $name = $code.".".$type;

                              if(is_uploaded_file($rfoto)){

                                $img_destino = "avatar/".$name;
                                $img_nombre = $name;
                                copy($rfoto, $img_destino);

                                $subir_query = "UPDATE usuario SET foto='$img_nombre' WHERE id='$yo'";
                                $subir_result = $conexion->query($subir_query);

                                if ($subir_result) {
                                  ?>
                                    <script type="text/javascript">
                                        location.href = 'perfil.php?id=<?php echo $_GET['id'];?>&perfil=publicacionesp';
                                    </script>
                                  <?php
                                }else{
                                  ?>
                                  <script>alert('Error al realizar consulta');</script>
                                  <?php
                                }               

                              }else{              
                                ?>
                                <script>alert('Error al subir la foto');</script>
                                <?php                                
                              }                 
                            }
                        }else{
                          if (unlink("avatar/".$buscarfoto) ){
                            if (validar($_FILES)) {
                              $queryr = "SHOW TABLE STATUS WHERE `Name` = 'publicaciones'";
                              $result = $conexion->query($queryr);
                              $data = $result->fetch_assoc();
                              $next_increment = $data['Auto_increment'];

                              $userpublic = $_SESSION['id'];
                              $fechanombreimg = date('Y-m-d');
                              $alea = $userpublic."-".$fechanombreimg."-".substr(strtoupper(md5(microtime(true))), 0,12);
                              $code = $next_increment.$alea;

                              $type = 'jpg';
                              $rfoto = $_FILES['fotoperfil']['tmp_name'];
                              $name = $code.".".$type;

                              if(is_uploaded_file($rfoto)){

                                $img_destino = "avatar/".$name;
                                $img_nombre = $name;
                                copy($rfoto, $img_destino);

                                $subir_query = "UPDATE usuario SET foto='$img_nombre' WHERE id='$yo'";
                                $subir_result = $conexion->query($subir_query);
                                if ($subir_result) {
                                  ?>
                                    <script type="text/javascript">
                                        location.href = 'perfil.php?id=<?php echo $_GET['id'];?>&perfil=publicacionesp';
                                    </script>
                                  <?php
                                }else{
                                  ?>
                                  <script>alert('Error al realizar consulta');</script>
                                  <?php
                                }               

                              }else{              
                                ?>
                                <script>alert('Error al subir la foto');</script>
                                <?php                                
                              }                 
                            }
                          }                          
                        }
                      }       
                    }
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
  <!-- FIN MODAL FOTO PERFIL -->

  <!--MODAL SEGUIDORES -->
      <div class="modal fade" id="modalseguidores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!-- si quitas data-dismiss="modal" no se cierra el modal con un alert-->
                <center><h4>Seguidores</h4></center>
              </div>

              <?php 
              if ($numseguidores == 0) { ?>
                <br>
                <center><p>No posee seguidores</p></center>
              <?php
              }else{ ?>
                <div class="modal-body"><!--#Body modal comentar-->
                  <?php
                  $idseguidoqm = $rowget['id'];
                  $miidperfil = $row['id'];
                  $querymodalseguidores = "SELECT * FROM seguidores WHERE seguido='$idseguidoqm'";
                  $resultmodalseguidores = $conexion->query($querymodalseguidores);

                  while ($rowmodalseguidores = $resultmodalseguidores->fetch_assoc()) {
                    $idseguidoqm = $rowmodalseguidores['seguidor'];
                    $queryseguidorm = "SELECT id,nombre,apellido,foto,verificado FROM usuario WHERE id='$idseguidoqm'";
                    $resultseguidorm = $conexion->query($queryseguidorm);
                    $nombreapellidoseguidor = $resultseguidorm->fetch_assoc();

                    $idseguidos = $rowmodalseguidores['seguidor'];
                    $querybtnseguirs = "SELECT * FROM seguidores WHERE seguidor='$miidperfil' AND seguido='$idseguidos'";
                    $resultbtnseguirs = $conexion->query($querybtnseguirs);
                    $rowbtnseguirs = $resultbtnseguirs->fetch_assoc();

                    $querymodaltesigue = "SELECT * FROM seguidores WHERE seguidor='$idseguidos' AND seguido='$miidperfil'";
                    $resultmodaltesigue = $conexion->query($querymodaltesigue);
                    $rowmodaltesigue = $resultmodaltesigue->fetch_assoc();

                    ?>
                    <ul class="list-group ">
                      <li class="list-group-item">
                        <div class="user-block">
                          <img class="img-circle" src="avatar/<?php echo $nombreapellidoseguidor['foto']; ?>" alt="User Image">
                            <?php
                            if ($nombreapellidoseguidor['verificado'] != 0) { ?>
                              <span class="description" onclick="location.href='perfil.php?id=<?php echo $nombreapellidoseguidor['id'];?>&perfil=publicacionesp';" style="cursor:pointer; color: red;"><?php echo $nombreapellidoseguidor['nombre']." ".$nombreapellidoseguidor['apellido']." ";?><i class="fa fa-check"></i></span>
                            <?php
                            }else{ ?>
                              <span class="description" onclick="location.href='perfil.php?id=<?php echo $nombreapellidoseguidor['id'];?>&perfil=publicacionesp';" style="cursor:pointer; color: red;"><?php echo $nombreapellidoseguidor['nombre']." ".$nombreapellidoseguidor['apellido']." ";?></span>
                            <?php
                            }
                            if ($idseguidoqm != $yo) {
                              if ($rowbtnseguirs) { ?>
                                <form class="" method="post">
                                  <?php
                                  if ($rowmodaltesigue) { ?>
                                    <button class="pull-right btn btn-danger btn-sm disabled" type="submit">Te sigue</button>
                                  <?php
                                  }
                                  ?>
                                  <button class="pull-right btn btn-primary btn-sm " type="submit" name="btnmodaldejarseguir<?php echo $idseguidos ; ?>">Dejar de seguir</button>
                                </form>
                                <?php
                                if(isset($_POST['btnmodaldejarseguir'.$idseguidos])){
                                  $querydejarseguir = "DELETE FROM seguidores WHERE seguidor='$miidperfil' AND seguido='$idseguidos'";
                                  $resultdejarseguir = $conexion->query($querydejarseguir);
                                  ?>
                                  <script type="text/javascript">
                                      location.href = 'perfil.php?id=<?php echo $rowget['id'];?>&perfil=publicacionesp';
                                  </script>
                                  <?php
                                }
                              }else{ ?>
                                <form class=""method="post">
                                  <?php
                                  if ($rowmodaltesigue) { ?>
                                    <button class="pull-right btn btn-danger btn-sm disabled" type="submit">Te sigue</button>
                                  <?php
                                  }
                                  ?>
                                  <button class="pull-right btn btn-primary btn-sm " type="submit" name="btnmodalseguir<?php echo $idseguidos ; ?>">Seguir</button>
                                </form>
                                <?php
                                if(isset($_POST['btnmodalseguir'.$idseguidos])){
                                  $queryseguir = "INSERT INTO seguidores (seguidor,seguido,fecha_reg) VALUES ('$miidperfil','$idseguidos',now())";
                                  $resultseguir = $conexion->query($queryseguir);
                                  ?>
                                  <script type="text/javascript">
                                      location.href = 'perfil.php?id=<?php echo $rowget['id'];?>&perfil=publicacionesp';
                                  </script>
                                  <?php
                                }
                              }
                            }
                          ?>
                        </div>
                      </li>
                    </ul>
                  <?php
                  }
                  ?>
                </div><!--/#Body modal editar datos-->              
              <?php
              }
              ?>

              <div class="modal-footer">
                <button type="button" name="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
              </div>

            </div>
        </div>
      </div>
  <!-- FIN MODAL SEGUIDORES -->

  <!--MODAL SEGUIDOS -->
      <div class="modal fade" id="modalseguidos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!-- si quitas data-dismiss="modal" no se cierra el modal con un alert-->
                <center><h4>Seguidos</h4></center>
              </div>

              <?php 
              if ($numseguidos == 0) { ?>
                <br>
                <center><p>No posee seguidos</p></center>
              <?php
              }else{ ?>
                <div class="modal-body"><!--#Body modal comentar-->
                  <?php
                  $idseguidoqm = $rowget['id'];
                  $miidperfil = $row['id'];
                  $querymodalseguidores = "SELECT * FROM seguidores WHERE seguidor='$idseguidoqm'";
                  $resultmodalseguidores = $conexion->query($querymodalseguidores);

                  while ($rowmodalseguidores = $resultmodalseguidores->fetch_assoc()) {
                    $idseguidoqm = $rowmodalseguidores['seguido'];
                    $queryseguidorm = "SELECT id,nombre,apellido,foto,verificado FROM usuario WHERE id='$idseguidoqm'";
                    $resultseguidorm = $conexion->query($queryseguidorm);
                    $nombreapellidoseguidor = $resultseguidorm->fetch_assoc();

                    $idseguidos = $rowmodalseguidores['seguido'];
                    $querybtnseguirs = "SELECT * FROM seguidores WHERE seguidor='$miidperfil' AND seguido='$idseguidos'";
                    $resultbtnseguirs = $conexion->query($querybtnseguirs);
                    $rowbtnseguirs = $resultbtnseguirs->fetch_assoc();

                    $querymodaltesigue = "SELECT * FROM seguidores WHERE seguidor='$idseguidos' AND seguido='$miidperfil'";
                    $resultmodaltesigue = $conexion->query($querymodaltesigue);
                    $rowmodaltesigue = $resultmodaltesigue->fetch_assoc();

                    ?>
                    <ul class="list-group ">
                      <li class="list-group-item">
                        <div class="user-block">
                          <img class="img-circle" src="avatar/<?php echo $nombreapellidoseguidor['foto']; ?>" alt="User Image">
                            <?php
                            if ($nombreapellidoseguidor['verificado'] != 0) { ?>
                              <span class="description" onclick="location.href='perfil.php?id=<?php echo $nombreapellidoseguidor['id'];?>&perfil=publicacionesp';" style="cursor:pointer; color: red;"><?php echo $nombreapellidoseguidor['nombre']." ".$nombreapellidoseguidor['apellido']." ";?><i class="fa fa-check"></i></span>
                            <?php
                            }else{ ?>
                              <span class="description" onclick="location.href='perfil.php?id=<?php echo $nombreapellidoseguidor['id'];?>&perfil=publicacionesp';" style="cursor:pointer; color: red;"><?php echo $nombreapellidoseguidor['nombre']." ".$nombreapellidoseguidor['apellido']." ";?></span>
                            <?php
                            }
                            if ($idseguidoqm != $yo) {
                              if ($rowbtnseguirs) { ?>
                                <form class="" method="post">
                                  <?php
                                  if ($rowmodaltesigue) { ?>
                                    <button class="pull-right btn btn-danger btn-sm disabled" type="submit">Te sigue</button>
                                  <?php
                                  }
                                  ?>
                                  <button class="pull-right btn btn-primary btn-sm " type="submit" name="btnmodaldejarseguir<?php echo $idseguidos ; ?>">Dejar de seguir</button>
                                </form>
                                <?php
                                if(isset($_POST['btnmodaldejarseguir'.$idseguidos])){
                                  $querydejarseguir = "DELETE FROM seguidores WHERE seguidor='$miidperfil' AND seguido='$idseguidos'";
                                  $resultdejarseguir = $conexion->query($querydejarseguir);
                                  ?>
                                  <script type="text/javascript">
                                      location.href = 'perfil.php?id=<?php echo $rowget['id'];?>&perfil=publicacionesp';
                                  </script>
                                  <?php
                                }
                              }else{ ?>
                                <form class=""method="post">
                                  <?php
                                  if ($rowmodaltesigue) { ?>
                                    <button class="pull-right btn btn-danger btn-sm disabled" type="submit">Te sigue</button>
                                  <?php
                                  }
                                  ?>
                                  <button class="pull-right btn btn-primary btn-sm " type="submit" name="btnmodalseguir<?php echo $idseguidos ; ?>">Seguir</button>
                                </form>
                                <?php
                                if(isset($_POST['btnmodalseguir'.$idseguidos])){
                                  $queryseguir = "INSERT INTO seguidores (seguidor,seguido,fecha_reg) VALUES ('$miidperfil','$idseguidos',now())";
                                  $resultseguir = $conexion->query($queryseguir);
                                  ?>
                                  <script type="text/javascript">
                                      location.href = 'perfil.php?id=<?php echo $rowget['id'];?>&perfil=publicacionesp';
                                  </script>
                                  <?php
                                }
                              }
                            }
                          ?>
                        </div>
                      </li>
                    </ul>
                  <?php
                  }
                  ?>
                </div><!--/#Body modal editar datos-->
              <?php  
              }
              ?>

              <div class="modal-footer">
                <button type="button" name="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
              </div>

            </div>
        </div>
      </div>
  <!-- FIN MODAL SEGUIDOS -->

  <!--MODAL MANGAS FAVORITOS -->
      <div class="modal fade" id="modalmangasf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!-- si quitas data-dismiss="modal" no se cierra el modal con un alert-->
                <center><h4>Mangas Favoritos</h4></center>
              </div>

                <div class="modal-body"><!--#Body modal comentar-->
                    <table class="table">
                      <tr>
                        <th><center>Nombre</center></th>
                        <th><center>Genero</center></th>
                        <th><center>Creador</center></th>
                      </tr>                  
                      <?php
                      $idusermanga = $rowget['id'];
                      $querymodalmangas = "SELECT id_manga FROM favorito WHERE id_usuario='$idusermanga'";
                      $resultmodalmangas = $conexion->query($querymodalmangas);

                      while ($rowmodalmangas = $resultmodalmangas->fetch_assoc()) {
                        $idmanga = $rowmodalmangas['id_manga'];
                        $querydatosmanga = "SELECT id,nombre,genero,creador FROM manga WHERE id='$idmanga'";
                        $resultdatosmanga = $conexion->query($querydatosmanga);
                        $datosmanga = $resultdatosmanga->fetch_assoc();

                        ?>
                            <tr>
                                <td>
                                  <center>
                                  <span class="description" onclick="location.href='manga.php?id=<?php echo $datosmanga['id'];?>';" style="cursor:pointer; color: red;"><?php echo $datosmanga['nombre'];?></span>
                                  </center> 
                                </td> 
                                <td>
                                  <center>
                                  <p><?php echo $datosmanga['genero'] ?></p>
                                  </center> 
                                </td>
                                <td>
                                  <center>
                                  <p><?php echo $datosmanga['creador'] ?></p>
                                  </center> 
                                </td>
                            </tr> 
                      <?php
                      }
                      ?>
 
                    </table>                
                </div><!--/#Body modal editar datos-->

              <div class="modal-footer">
                <button type="button" name="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
              </div>

            </div>
        </div>
      </div>
  <!-- FIN MODAL MANGAS FAVORITOS -->

  <!-- /.content-wrapper -->
  
  <!-- FOOTER-->
  <?php include('footer.php'); ?>
  <!-- /FOOTER-->

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
<!-- SCRIPT PARA EL VISOR DE IMAGEN -->
<script src="dist/js/lightbox.js"></script>
<!-- SCRIPT VALIDAR CONTRASEÑAS -->
<script>
  $(document).ready(function(){
     $('#repetircontra').keyup(function(){
      var contra = document.getElementById('nuevacontra').value;
      var repetir = document.getElementById('repetircontra').value;

      if (contra == repetir) {
        $('#repetir').removeClass('has-error');
        $('#repetir').addClass('has-success');
        $('#iguales').removeClass('hidden');
        $('#diferentes').addClass('hidden');
      }else{
        $('#repetir').removeClass('has-success');
        $('#repetir').addClass('has-error');
        $('#diferentes').removeClass('hidden');
        $('#iguales').addClass('hidden');
      }
    });             
  });
</script>
</body>
</html>