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

    $pag = $_GET['noticia'];

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="dist/img/favicon.ico" type="imege/x-icon">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kuroinku | Noticias</title>
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

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">
        <!--NOTICIAS MANGAS-->
        <section class="col-lg-12 ">
          <div class="box box-widget">
            <div class="nav-tabs">
              <ul class="nav nav-tabs">
                <li class="<?php echo $pag == 'nmangas' ? 'active' : ''; ?>"><a href="?noticia=nmangas" style="color:black;">Noticias Mangas</a></li>
                <li class="<?php echo $pag == 'nkuroinku' ? 'active' : ''; ?>"><a href="?noticia=nkuroinku" style="color:black;">Noticias Kuroinku</a></li>
              </ul>

              <div class="tab-conten">
                  <div class="scroll">
                    <?php
                    $pagina = isset($_GET['noticia']) ? strtolower($_GET['noticia']) : 'nmangas';
                    require_once $pagina.'.php';
                    ?>
                  </div>
              </div>
            </div>
          </div>
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
</body>
</html>
