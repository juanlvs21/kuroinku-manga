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
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="dist/img/favicon.ico" type="imege/x-icon">
  <title>Kuroinku | Sesión</title>
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
<body class="hold-transition login-page" style="background-image: url('dist/img/fondo/fondoj.jpg');">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><img src="dist/img/logo/logo.png" alt="" width="200" height="auto"></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h4 class="login-box-msg">Iniciar Sesión</h4>

    <form action="" method="post" id="formlogin">
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="usuariolg" name="usuariolg" placeholder="Usuario" required pattern="[A-Za-z0-9_-]{1,30}">
          <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
        </div>
        <center><div id="verifiuser"></div></center>
      </div> 
      <div class="form-group">
        <div class="input-group">
          <input type="password" class="form-control" id="passlg" name="passlg" placeholder="Contraseña" required pattern="[A-Za-z0-9_-]{1,70}">
          <div class="input-group-addon"><span class="glyphicon glyphicon-lock" title="Mostrar contraseña" id="vercontra" onmouseover="encima()" onmouseout="noencima()"></span></div>
        </div>
      </div>    
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6 col-xs-offset-3">
            <button type="submit" class="btn btn-danger btn-block btn-flat" id="botonlg" name="botonlg">Iniciar sesión</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <center><div id="register"></div></center>
    <center><img src="dist/img/loading.gif" class="hidden" id="loadingregister" alt="" width="100" height="100" border="0"></center> 
    
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



    <div class="social-auth-links text-center">
      <p>- También puede -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> <center>Iniciar sesión con Facebook</center></a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> <center>Iniciar sesión con Google+</center></a>
    </div>
    <!-- /.social-auth-links -->

    <center>
      <a href="#">Olvidé mi contraseña</a><br>
      <a href="registrar.php" class="text-center">Registrar una cuenta</a>
    </center>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){
    $('#formlogin').submit(function(){
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
        })
        .fail(function(respuesta2){
            console.log('Error al iniciar session');
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