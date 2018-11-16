<?php
    include("config/conexion.php");

    session_start();

    if(isset($_SESSION['usuario'])){
      header('Location: index.php');

    }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="dist/img/favicon.ico" type="imege/x-icon">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kuroinku | Bienvenido</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/red.css">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"-->
  <script>
    function encima(){
      $('#vercontra').removeClass('glyphicon-lock');
      $('#vercontra').addClass('glyphicon-eye-open');
    }
    function noencima(){
      $('#vercontra').removeClass('glyphicon-eye-open');
      $('#vercontra').addClass('glyphicon-lock');
    }       
  </script>  
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

<?php 
  include("headerlogin.php");
?>

  <!-- Left side column. contains the logo and sidebar -->
<?php 
  include("siderbarlogin.php");
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

      <div class="row">
        <div id="slidermanga" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#slidermanga" data-slide-to="0" class="active"></li>
            <li data-target="#slidermanga" data-slide-to="1"></li>
            <li data-target="#slidermanga" data-slide-to="2"></li>
            <li data-target="#slidermanga" data-slide-to="3"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              <img src="dist/img/slider/slider1g.jpg" alt="Bienvenido" class="img-responsive" style="width: 100%">
            </div>

            <div class="item">
              <img src="dist/img/slider/slider2g.jpg" alt="Mundo Manga" class="img-responsive" style="width: 100%">
            </div>

            <div class="item">
              <img src="dist/img/slider/slider3g.jpg" alt="Biblioteca" class="img-responsive" style="width: 100%">
            </div>

            <div class="item">
              <img src="dist/img/slider/slider4g.jpg" alt="Comunidad" class="img-responsive" style="width: 100%">
            </div>
          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control" href="#slidermanga" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#slidermanga" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    <!-- Main content -->
    <section class="content">
      <center>
        <h1><i>Únete al Clan.</i></h1>
      </center>
      <p>
        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 

        Forma parte la Comunidad <b>Kuroinku</b> y adentrate en un inmenso mundo entre tinta y papel mientras te sumerges en cada historia, cada capitulo, cada pagina. <br><br>

        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        Expresa tus ideales, comparte tus conocimientos, plasma tus opiniones a través de nuestro foro dirigido a la comunidad, mediante este espacio podrás aclarar tus dudas así como también despejar las tinieblas de la incertidumbre entre miembros de nuestro clan. Se agredece ser lo mas cortés posible, recuerda puedes ser la luz que aclare las confusiones de otro pero tambien puedes ser aquel que se encuentre con la mente nublada. <br><br> 

        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        En <b>Kuroinku</b> los miembros de nuestro clan son de gran importancia para nosotros, por eso te otorgamos la posibilidad de personalizar tu perfil y así darle a nuestros miembros su propia personalidad. ¡Pero eso no es todo!, como ya sabes puedes interactuar con otros miembros a través del foro, pero también puedes tener una conversación privada directamente con alguien (descuida no es con aves mensajeras) para eso <b>Kuroinku</b> posee una seccion de chat. 
  
        <center>Lo mas importante es divertirse, que <b>Amaterasu</b> los guie con su luz.</center>
      </p>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!--MODAL SESION -->
  <div class="modal fade" id="modalsesion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <!-- si quitas data-dismiss="modal" no se cierra el modal con un alert-->
            <center><h4>Iniciar Sesión</h4></center>
          </div>
          <div class="modal-body"><!--#Body modal-->
            <div>
              <center>
                <img src="dist/img/logo/logo.png" alt="" class="img-responsive" width="200">
              </center>
            </div>
            <br>
            <form action="" method="post" id="formlogin">
              <div class="form-group">
                <div class="input-group col-md-8 col-md-offset-2">
                  <input type="text" class="form-control" id="usuariolg" name="usuariolg" placeholder="Usuario" required pattern="[A-Za-z0-9_-]{1,30}">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                </div>
                <center><div id="verifiuser"></div></center>
              </div> 
              <div class="form-group">
                <div class="input-group col-md-8 col-md-offset-2">
                  <input type="password" class="form-control" id="passlg" name="passlg" placeholder="Contraseña" required pattern="[A-Za-z0-9_-]{1,70}">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-lock" title="Mostrar contraseña" id="vercontra" onmouseover="encima()" onmouseout="noencima()"></span></div>
                </div>
              </div>    
              <div class="row">
                <!-- /.col -->
                <div class="col-xs-4 col-xs-offset-4">
                    <button type="submit" class="btn btn-danger btn-block btn-flat" id="botonlg" name="botonlg">Iniciar sesión</button>
                </div>
                <!-- /.col -->
              </div>
            </form>  
            <center><div id="register"></div></center>
            <center><img src="dist/img/loading.gif" class="hidden" id="loadingregister" alt="" width="100" height="100" border="0"></center>   
            <div>
              <br>
              <center>
                <a href="#" style="color: red">Olvidé mi contraseña</a><br>
              </center>              
            </div> 
            <?php
                if (isset($_POST['botonlg'])) {

                  $usuariolg = mysqli_real_escape_string($conexion,$_POST['usuariolg']);
                  $usuariolg = strip_tags($_POST['usuariolg']);
                  $usuariolg = trim($_POST['usuariolg']);

                  $passlg = strip_tags(md5($_POST['passlg']));
                  $passlg = trim(md5($_POST['passlg']));
                  $passlg = mysqli_real_escape_string($conexion,md5($_POST['passlg']));

                  $query = "SELECT * FROM usuario WHERE usuario='$usuariolg' AND contra='$passlg '";
                  $result = $conexion->query($query);
                  $comprobar = $result->num_rows;

                  if ($comprobar == 1) {
                    while ($row = $result->fetch_assoc()) {
                      if (($usuariolg == $row['usuario']) && ($passlg == $row['contra'])) {
                        if ($row['betado'] == 1) { ?>
                          <br>
                          <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" name="button2" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <center>Lo sentimos <?php $row['nombre']." ".$row['apellido'] ?> usted ha sido betado hasta nuevo aviso</center>
                          </div>
                        <?php
                        }else{
                          $_SESSION['usuario'] = $row['usuario'];
                          $_SESSION['id'] = $row['id'];
                          ?>
                          <br>
                          <center><img src="dist/img/loading.gif" alt="" width="100" height="100" border="0"></center>
                          <script type="text/javascript">
                            setTimeout(function(){
                              location.href = 'index.php'
                            },1000);
                          </script>
                          <?php
                        }
                      }
                    }
                  }else{
                    ?>
                    <br>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" name="button2" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <center>Usuario/Contraseña Incorrectos</center>
                    </div>
                    <?php
                  }

                }
            ?>    
          </div><!--/#Body Sesion-->

          <div class="modal-footer">
            <button type="button" name="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
          </div>

        </div>
    </div>
  </div>
  <!-- FIN MODAL SESION -->

  <!--MODAL REGISTRAR -->
  <div class="modal fade" id="modalregistrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <!-- si quitas data-dismiss="modal" no se cierra el modal con un alert-->
            <center><h4>Iniciar Sesión</h4></center>
          </div>
          <div class="modal-body"><!--#Body modal-->
            <form action="" method="post" id="formregister">
              <div class="form-group">
                <div class="input-group col-md-8 col-md-offset-2">
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php //echo $_POST['usuario']; ?>" required pattern="[A-Za-z0-9_-]{1,30}">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                </div>
                <center><div id="verifiuser"></div></center>
              </div> 
              <div class="form-group">
                <div class="input-group col-md-8 col-md-offset-2">
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php //echo $_POST['nombre']; ?>" required pattern="[A-Za-z0-9_-. ]{1,30}">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                </div>
              </div>  
              <div class="form-group">
                <div class="input-group col-md-8 col-md-offset-2">
                  <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?php //echo $_POST['apellido']; ?>" required pattern="[A-Za-z0-9_-]{1,30}">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                </div>
              </div>  
              <div class="form-group">
                <div class="input-group col-md-8 col-md-offset-2">
                  <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" value="<?php //echo $_POST['correo']; ?>" required pattern="[A-Za-z0-9_-@]{1,30}">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                </div>
                <center><div id="verifimail"></div></center>
              </div>  
              <div class="form-group">
                <label for="fecha_nac" class="col-md-8 col-md-offset-2">Fecha nacimiento</label>
                <div class="input-group col-md-8 col-md-offset-2">
                  <input type="date" class="form-control" name="fecha_nac" id="fecha_nac">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                </div>
              </div> 
              <div class="form-group">
                <label for="sexo" class="col-md-8 col-md-offset-2">Sexo</label>
                <div class="input-group col-md-8 col-md-offset-2">
                  <select class="form-control" name="sexo" id="sexo">
                    <option value="Prefiero no decirlo">Prefiero no decirlo</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                  </select>
                  <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                </div>
              </div> 
              <div class="form-group">
                <div class="input-group col-md-8 col-md-offset-2">
                  <input type="password" class="form-control" id="contra" name="contra" placeholder="Contraseña" required pattern="[A-Za-z0-9_-]{1,30}">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-lock" title="Mostrar contraseña" id="vercontra" onmouseover="encima()" onmouseout="noencima()"></span></div>
                </div>
              </div>          
              <div class="form-group">
                <div class="input-group col-md-8 col-md-offset-2">
                  <input type="password" class="form-control" id="confircontra" name="confircontra" placeholder="Repetir contraseña" required pattern="[A-Za-z0-9_-]{1,30}">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-lock" title="Mostrar contraseña" id="vercontra2" onmouseover="encima2()" onmouseout="noencima2()"></span></div>
                </div>
                <center>
                  <div id="verifipass" class="hidden">
                    <span style="color: red">Contraseñas no coinciden</span>
                    <br>    
                  </div>
                </center>         
              </div>     
              <div class="row">
                <div class="col-xs-12">
                  <div class="checkbox icheck col-md-8 col-md-offset-2">
                    <label>
                      <input type="checkbox" required id="terminos"> Acepto los <a href="terminos.php" style="color: red">Terminos y condiciones</a>
                    </label>
                    <center><div id="verificarterminos" class="hidden"><span style="color: red">Debe aceptar los terminos y condiciones</span></div></center>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4 col-xs-offset-4">
                  <button type="submit"  class="btn btn-danger btn-block btn-flat" id="btnregistrar" name="btnregistrar">Register</button>
                </div>     
                <!-- /.col -->
              </div>
            </form>
                <center><div id="register"></div></center>
                <center><img src="dist/img/loading.gif" class="hidden" id="loadingregister" alt="" width="100" height="100" border="0"></center>
                <div class="alert alert-danger alert-dismissible hidden" id="errordesconocido">
                  <button type="button" class="close" name="button3" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <center>
                    <br>
                    <p>Error - No es posible crear cuenta en este momento, intente mas tarde </p>
                  </center>
                </div> 
                <div id="exito" class="hidden">
                  <br>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" name="button34" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <center>¡Felicidades!, se ha registrado satisfactoriamente</center>
                  </div>
                  <br>                  
                </div>      

            <?php
                if (isset($_POST['btnregistrar'])) {
                    ?>
                    <script>
                      console.log('Boton registrar presionado');
                    </script>
                    <?php

                    $usuario = mysqli_real_escape_string($conexion,$_POST['usuario']);
                    $nombre = mysqli_real_escape_string($conexion,$_POST['nombre']);
                    $apellido = mysqli_real_escape_string($conexion,$_POST['apellido']);
                    $correo = mysqli_real_escape_string($conexion,$_POST['correo']);
                    $fecha_na = $_POST['fecha_nac'];
                    $contra = mysqli_real_escape_string($conexion,md5($_POST['contra']));
                    $confircontra = mysqli_real_escape_string($conexion,md5($_POST['confircontra']));
                    //$ruta = "perfil/";
                    //$foto = $ruta.basename($_FILES['fotografia']['name']);

                    $query = "SELECT usuario FROM usuario WHERE usuario='$usuario'";
                    $result = $conexion->query($query);
                    $comprobarusu = $result->num_rows;

                    $query2 = "SELECT correo FROM usuario WHERE correo='$correo'";
                    $result2 = $conexion->query($query2);
                    $comprobarcorreo = $result->num_rows;

                    if ($comprobarusu >= 1) { ?>
                        <br>
                        <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" name="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <center>Error - Usuario ya registrado</center>
                        </div>
                    <?php
                    }else{
                        if ($comprobarcorreo >= 1) { ?>
                            <br>
                            <div class="alert alert-danger alert-dismissible">
                              <button type="button" class="close" name="button2" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <center>Error - Correo electronico ya registrado</center>
                            </div>
                        <?php
                        }else{
                            if ($contra != $confircontra) { ?>
                              <br>
                              <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" name="button3" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <center>Error - Contraseñas no coinciden</center>
                              </div>
                            <?php
                            }else{
                              $fecha_nac = date_format((new DateTime($fecha_na)), 'Y-m-d');

                              $query3 = "INSERT INTO usuario (usuario,nombre,apellido,correo,fecha_nac,contra,fecha_reg) VALUES ('$usuario','$nombre','$apellido','$correo','$fecha_nac','$contra',now())";
                              $result3 = $conexion->query($query3);

                              if ($result3) { ?>
                                  <br>
                                  <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" name="button34" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <center>¡Felicidades!, se ha registrado satisfactoriamente</center>
                                  </div>
                                  <br>
                                  <center><img src="dist/img/loading.gif" alt="" width="100" height="100" border="0"></center>

                                  <script type="text/javascript">
                                    setTimeout(function(){
                                      location.href = 'index.php';
                                    },1000);
                                  </script>

                                  <?php

                                /*if (move_uploaded_file($_FILES['fotografia']['tmp_name'], $destinoimg)){
                                  header('Location: panelf.php');
                                }*/
                              }else{ ?>
                                <br>
                                <div class="alert alert-danger alert-dismissible">
                                  <button type="button" class="close" name="button3" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <center>
                                    <p>Error - No es posible crear cuenta en este momento, intente mas tarde </p>
                                  </center>
                                </div>
                              <?php
                              }
                            }
                        }
                    }
                }
            ?>



            <div class="social-auth-links text-center">
              <p>- También puede -</p>
              <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> <center>Iniciar sesión con Facebook</center></a>
              <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> <center>Iniciar sesión con Google+</center></a>
            </div>

            <center><a href="index.php" class="text-center">Ya poseo cuenta, Iniciar sesión</a></center>            
          </div><!--/#Body Sesion-->

          <div class="modal-footer">
            <button type="button" name="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
          </div>

        </div>
    </div>
  </div>
  <!-- FIN MODAL REGISTRAR -->

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
<!-- SCRIPT LIGHTBOX -->
<script src="dist/js/lightbox.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-red',
      radioClass: 'iradio_square-red',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script>
  $(document).ready(function(){
    $('#usuario').keyup(function(){
      var usuario = document.getElementById('usuario').value;

      if (usuario != "") {
        var datos = 'usuario='+usuario;


        $.ajax({
            type: "POST",
            url: "real/verificarusuario.php",
            data: datos,
            dataType:"html",
            asycn:false,
            success: function(){
              console.log('Datos enviados para verificar usuario');
            }
        })
        .done(function(respuesta2){
            console.log('Consulta realizada para verificar usuario');
            $("#verifiuser").html(respuesta2);
        })
        .fail(function(respuesta2){
            console.log('Error al verificar usuario');
        })         
      }     
    });
  });
</script>
<script>
  $(document).ready(function(){
    $('#correo').keyup(function(){
      var correo = document.getElementById('correo').value;

      if (correo != "") {
        var datos = 'correo='+correo;


        $.ajax({
            type: "POST",
            url: "real/verificarcorreo.php",
            data: datos,
            dataType:"html",
            asycn:false,
            success: function(){
              console.log('Datos enviados para verificar correo');
            }
        })
        .done(function(respuesta2){
            console.log('Consulta realizada para verificar correo');
            $("#verifimail").html(respuesta2);
        })
        .fail(function(respuesta2){
            console.log('Error al verificar correo');
        })         
      }     
    });
  });
</script>
<script>
  $(document).ready(function(){
    $('#confircontra').keyup(function(){
      var confircontra = document.getElementById('confircontra').value;
      var contra = document.getElementById('contra').value;

      if (confircontra != contra) {
        $('#verifipass').removeClass('hidden');
      }else{
        $('#verifipass').addClass('hidden');        
      }
    });
  });
</script>

<script>
  $(document).ready(function(){
    $('#formregister').submit(function(){
      console.log('Prepara Ajax para Registrar');
      $('#registrar').addClass('disabled');

      var usuario = document.getElementById('usuario').value;
      var nombre = document.getElementById('nombre').value;
      var apellido = document.getElementById('apellido').value;
      var correo = document.getElementById('correo').value;
      var fecha_nac = document.getElementById('fecha_nac').value;
      var sexo = document.getElementById('sexo').value;
      var contra = document.getElementById('contra').value;
      var confircontra = document.getElementById('confircontra').value;
      var checkcorreo = document.getElementById('checkcorreo').value;
      var checkuser = document.getElementById('checkuser').value;

      if ($('#terminos').is(':checked')) {
        $('#verificarterminos').addClass('hidden');

        if ((checkcorreo == 1) && (checkuser == 1)) {
          console.log('REGISTRANDO');
          if (contra == confircontra) {

            $('#loadingregister').removeClass('hidden');

            var datos = 'usuario='+usuario;
            datos += '&nombre='+nombre;
            datos += '&apellido='+apellido;
            datos += '&correo='+correo;
            datos += '&fecha_nac='+fecha_nac;
            datos += '&sexo='+sexo;
            datos += '&contra='+contra;

            $.ajax({
                type: "POST",
                url: "real/registrar.php",
                data: datos,
                dataType:"html",
                asycn:false,
                success: function(){
                  console.log('Datos enviados para registrar');
                  $('#loadingregister').addClass('hidden');
                }
            })
            .done(function(respuesta2){
                console.log('Consulta realizada registrar');
                $("#register").html(respuesta2);
                $('#exito').removeClass('hidden');
                $('#registrar').removeClass('disabled');
            })
            .fail(function(respuesta2){
                console.log('Error al registrar');
                $('#errordesconocido').removeClass('hidden');
                $('#loadingregister').addClass('hidden');
                $('#registrar').removeClass('disabled');
            })               
          }          
        }
      }else{
        $('#verificarterminos').removeClass('hidden');
      }
      event.preventDefault();
    });
  });
</script>
<script>
  $(document).ready(function(){
    $('#vercontra').click(function(){
      var tipo = document.getElementById('contra').type;
      
      if (tipo == "password") {
        document.getElementById('contra').type='text';
      }

      if (tipo == "text") {
        document.getElementById('contra').type='password';
      }
    });

    $('#vercontra2').click(function(){
      var tipo2 = document.getElementById('confircontra').type;
      
      if (tipo2 == "password") {
        document.getElementById('confircontra').type='text';
      }

      if (tipo2 == "text") {
        document.getElementById('confircontra').type='password';
      }
    });
  });
</script>
<script>
  function encima(){
    $('#vercontra').removeClass('glyphicon-lock');
    $('#vercontra').addClass('glyphicon-eye-open');
  }
  function noencima(){
    $('#vercontra').removeClass('glyphicon-eye-open');
    $('#vercontra').addClass('glyphicon-lock');
  }
  function encima2(){
    $('#vercontra2').removeClass('glyphicon-lock');
    $('#vercontra2').addClass('glyphicon-eye-open');
  }
  function noencima2(){
    $('#vercontra2').removeClass('glyphicon-eye-open');
    $('#vercontra2').addClass('glyphicon-lock');
  }
</script>
<script>
  $(document).ready(function(){
    $('#formlogin').submit(function(){
      $('#botonlg').addClass('disabled');
      var usuario = document.getElementById('usuariolg').value;
      var contra = document.getElementById('passlg').value;

      if ((usuario != "")&&(contra != "")) {
        $('#loadingregister').removeClass('hidden');
        
        var datos = 'usuario='+usuario;
        datos += '&contra='+contra;

        $.ajax({
            type: "POST",
            url: "real/login.php",
            data: datos,
            dataType:"html",
            asycn:false,
            success: function(){
              console.log('Datos enviados para iniciar session');
              $('#loadingregister').addClass('hidden');
            }
        })
        .done(function(respuesta2){
            console.log('Consulta realizada iniciar session');
            $("#register").html(respuesta2);
            $('#botonlg').removeClass('disabled');
        })
        .fail(function(respuesta2){
            console.log('Error al iniciar session');
            $('#botonlg').removeClass('disabled');
        })          
      }; 
      event.preventDefault();
    });
  });
</script>
<script>
  $(document).ready(function(){
    $('#vercontra').click(function(){
      var tipo = document.getElementById('passlg').type;
      
      if (tipo == "password") {
        document.getElementById('passlg').type='text';
      }

      if (tipo == "text") {
        document.getElementById('passlg').type='password';
      }
    });   
  });
</script>
</body>
</html>
