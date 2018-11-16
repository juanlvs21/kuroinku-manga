<?php
    session_start();

    include("config/conexion.php");

    ini_set('error_reporting',0);

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="dist/img/favicon.ico" type="imege/x-icon">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kuroinku | Registrar cuenta</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

 <!-- Google Font -->
  <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"-->

</head>
<body class="hold-transition register-page" style="background-image: url('dist/img/fondo/fondoj.jpg');">
<div class="register-box">
  <div class="register-logo">
    <a href="index.php"><img src="dist/img/logo/logo.png" alt="" width="200" height="auto"></a>
  </div>

  <div class="register-box-body">
    <h4 class="login-box-msg">Registrar nueva cuenta</h4>

    <form action="" method="post" id="formregister">
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo $_POST['usuario']; ?>" required pattern="[A-Za-z0-9_-]{1,30}">
          <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
        </div>
        <center><div id="verifiuser"></div></center>
      </div> 
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $_POST['nombre']; ?>" required pattern="[A-Za-z0-9_-. ]{1,30}">
          <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
        </div>
      </div>  
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo $_POST['apellido']; ?>" required pattern="[A-Za-z0-9_-]{1,30}">
          <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
        </div>
      </div>  
      <div class="form-group">
        <div class="input-group">
          <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" value="<?php echo $_POST['correo']; ?>" required pattern="[A-Za-z0-9_-@]{1,30}">
          <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
        </div>
        <center><div id="verifimail"></div></center>
      </div>  
      <div class="form-group">
        <label for="fecha_nac">Fecha nacimiento</label>
        <div class="input-group">
          <input type="date" class="form-control" name="fecha_nac" id="fecha_nac">
          <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
        </div>
      </div> 
      <div class="form-group">
        <label for="sexo">Sexo</label>
        <div class="input-group">
          <select class="form-control" name="sexo" id="sexo">
            <option value="Prefiero no decirlo">Prefiero no decirlo</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
          </select>
          <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
        </div>
      </div> 
      <div class="form-group">
        <div class="input-group">
          <input type="password" class="form-control" id="contra" name="contra" placeholder="Contraseña" required pattern="[A-Za-z0-9_-]{1,30}">
          <div class="input-group-addon"><span class="glyphicon glyphicon-lock" title="Mostrar contraseña" id="vercontra" onmouseover="encima()" onmouseout="noencima()"></span></div>
        </div>
      </div>          
      <div class="form-group">
        <div class="input-group">
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
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" required id="terminos"> Acepto los <a href="#">Terminos y condiciones</a>
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

    <?php
        if (isset($_POST['btnregistrar'])) {

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
                          <!--br>
                          <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" name="button34" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <center>¡Felicidades!, se ha registrado satisfactoriamente</center>
                          </div-->
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
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
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
            })
            .fail(function(respuesta2){
                console.log('Error al registrar');
                $('#errordesconocido').removeClass('hidden');
                $('#loadingregister').addClass('hidden');
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
</body>
</html>