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

    //Marcando el leido
    if(isset($_GET['leido'])) {
      $leido = mysqli_real_escape_string($conexion,$_GET['leido']);
      $usuariod = mysqli_real_escape_string($conexion,$_GET['usuario']);

      $tchats = $conexion->query("SELECT * FROM chats WHERE de = '$usuariod' AND para = '$yo' AND leido='0'");
      $tc = $tchats->num_rows;

      if($tc != 0) {
        $update = $conexion->query("UPDATE chats SET leido = '1' WHERE de = '$usuariod' AND para = '$yo'");
      }
    }

    //Cargando numero de mensajes no leidos
    $querynumchat = $conexion->query("SELECT * FROM chats WHERE para='$yo' AND leido='0'");
    $numchats = $querynumchat->num_rows;

  //VARIABLES
    $user = mysqli_real_escape_string($conexion,$_GET['usuario']);
    $sess = $_SESSION['id'];
    $querynombrechat = $conexion->query("SELECT nombre,apellido FROM usuario WHERE id='$user'");
    $nombrechat = $querynombrechat->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="dist/img/favicon.ico" type="imege/x-icon">
  <title>Kuroinku | Chat</title>
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
 
  <script>
    /*$(document).ready(function(){
        $('#scrollchat').slimScroll({
            width: '300px',
            height: '500px',
            size: '10px',
            position: 'right',
            color: 'red',
            alwaysVisible: true,
            distance: '20px',
            start: 'bottom',
            railVisible: true,
            railColor: '#222',
            railOpacity: 0.3,
            wheelStep: 10,
            allowPageScroll: false,
            disableFadeOut: false
        });
    });*/
  </script> 

  <script>
    $(function(){
      $("#enviarmsj").click(function(){

        $('#enviarmsj').addClass('hidden');
        $('#gifenviar').removeClass('hidden');
        $('#msj').addClass('disabled');

        var msj = document.getElementById("msj").value;
        var userchat = document.getElementById("userchat").value;

        $("#msj").val("");  

        var chat = "mensaje=";
        chat += msj;
        chat += "&para=";
        chat += userchat;

        if (msj == "") {
        }else{
          $.ajax({
              type: "POST",
              url: "enviarchat.php",
              data: chat,
              dataType:"html",
              asycn:false,
              success: function(){
                console.log('Datos enviados');
              } 
          })
          .done(function(respuesta2){
              console.log('Consulta Realizada');
              $('#enviarmsj').removeClass('hidden');
              $('#gifenviar').addClass('hidden');
              $('#msj').removeClass('disabled');
          })
          .fail(function(respuesta2){
              console.log('error');
          })
        }
        event.preventDefault();
      });
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
    <section class="content-header">
      <h1>
        Chat
        <small><?php echo $numchats ?> nuevos mensajes</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Kuroinku</a></li>
        <li class="active">Chat</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!--a href="chats.php" class="btn btn-danger btn-block margin-bottom">Todos los mensajes</a-->

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Carpetas</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="chats.php"><i class="fa fa-inbox"></i> Personas
                  <span class="label label-danger pull-right"><?php echo $numchats ?></span></a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-danger">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!-- /.mailbox-read-info -->
              <div class="mailbox-read-message">
              <!-- Direct Chat -->
                <div class="row">
                  <div class="col-md-12">
                    <!-- DIRECT CHAT PRIMARY -->
                      <div class="box-header with-border">
                        <span onclick="location.href='perfil.php?id=<?php echo $user;?>&perfil=publicacionesp';" style="cursor:pointer; color: black;"><h3 class="box-title"><?php echo $nombrechat['nombre']." ".$nombrechat['apellido']; ?></h3></span>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <!-- Conversations are loaded here -->
                        <input type="text" class="hidden" value="<?php echo $user ?>" id="userm">

                        <div class="direct-chat-messages" id="scrollchat" style="/*overflow: scroll;*/ height: 400px;">  
                        <!-- CHAT EN TIEMPO REAL CON AJAX-->    
                          <div id="cargandochat">
                        
                          </div>
                          <input type="text" id="userm" value="$user" class="hidden">              
                          <div id="chatrt">
                          </div>
                        </div>
                        <!--/.direct-chat-messages-->

                        <!-- Contacts are loaded here -->
                      </div>

                      <!-- /.box-body -->
                      <div class="box-footer">
                        <form action="" method="post" id="formchat">
                          <div class="input-group">
                            <input type="text" name="mensaje" id="msj" placeholder="Escribe un mensaje" class="form-control" required="">
                                <span class="input-group-btn">
                                  <input type="text" class="hidden" value="<?php echo $_GET['usuario'] ?>" id="userchat" name="para">
                                  <button type="submit" name="enviar" class="btn btn-danger btn-flat" id="enviarmsj">Enviar <i class="fa fa-send"></i></button>
                                  <div class="btn btn-flat btn-danger hidden" disabled id="gifenviar">
                                    <img class="" src="dist/img/loadingchat.gif" alt="" width="55" height="17">
                                  </div>
                                </span>
                          </div>
                        </form>

                        <?php 
                        if (isset($_POST['enviar'])) {
                          $mensaje = mysqli_real_escape_string($conexion,$_POST['mensaje']);
                          $prev = substr($mensaje, 0, 19);
                          $de = $_SESSION['id'];
                          $para = mysqli_real_escape_string($conexion,$_POST['para']);

                          $comprobar = $conexion->query("SELECT * FROM c_chats WHERE de = '$de' AND para = '$para'");
                          $comprobar2 = $conexion->query("SELECT * FROM c_chats WHERE de = '$para' AND para = '$de'");
                          

                          if (($comprobar->num_rows == 0) && ($comprobar2->num_rows == 0)) {
                            $cyc = 0;
                            $com = $comprobar->fetch_assoc();
                          }
                          if ($comprobar->num_rows == 1) {
                            $cyc = 1;
                            $com = $comprobar->fetch_assoc();
                          }
                          if ($comprobar2->num_rows == 1) {
                            $cyc = 1;
                            $com = $comprobar2->fetch_assoc();
                          }

                          if($cyc == 0) {
                            $insert = $conexion->query("INSERT INTO c_chats (de,para) VALUES ('$de','$para')");
                            $siguiente = $conexion->query("SELECT id_cch FROM c_chats WHERE de = '$de' AND para = '$para' OR de = '$para' AND para = '$de'");
                            $si = $siguiente->fetch_assoc();
                            $insert2 = $conexion->query("INSERT INTO chats (id_cch,de,para,mensaje,prev,fecha,leido) VALUES ('".$si['id_cch']."','$de','$para','$mensaje','$prev',now(),'0')");
                            if($insert) {}
                          }
                          else
                          {
                            $insert3 = $conexion->query("INSERT INTO chats (id_cch,de,para,mensaje,prev,fecha,leido) VALUES ('".$com['id_cch']."','$de','$para','$mensaje','$prev',now(),'0')");
                            if($insert3) {}
                          }
                        }
                        ?>

                      </div>
                      <!-- /.box-footer-->
                  </div> 
                  <!-- /.col -->
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Page Script -->
<script>
 /* $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });*/
</script>
<!-- SCRIPT PARA CARGAR MENSAJES EN TIEMPO REAL -->
<script src="real/cargarmensajes.js"></script>
<!-- SCRIPT PARA CARGAR NOTIFICACIONES EN TIEMPO REAL -->
<script src="real/cargarnotificaciones.js"></script>
<!-- SCRIPT PARA CARGAR NUMERO MENSAJES HEADER EN TIEMPO REAL -->
<script src="real/bnm-header.js"></script>
<!-- SCRIPT PARA CARGAR NUMERO MENSAJES SIDEBAR EN TIEMPO REAL -->
<script src="real/bnm-sidebar.js"></script>
<!-- SCRIPT PARA CARGAR CHAT EN TIEMPO REAL -->
<script src="real/cargarchat.js"></script>
<!-- SCRIPT PARA CARGAR NUMERO NOTIFICACIONES EN TIEMPO REAL -->
<script src="real/bnnotifi.js"></script>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery 3 -->
<!--script src="bower_components/jquery/dist/jquery.min.js"></script-->
</body>
</html>
