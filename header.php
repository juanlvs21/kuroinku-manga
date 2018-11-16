<?php
$querynumseguidores2 = "SELECT * FROM seguidores WHERE seguido='$yo'";
$resultnumseguidores2 = $conexion->query($querynumseguidores2);
$numseguidores2 = $resultnumseguidores2->num_rows;

$querynumseguidos2 = "SELECT * FROM seguidores WHERE seguidor='$yo'";
$resultnumseguidos2 = $conexion->query($querynumseguidos2);
$numseguidos2 = $resultnumseguidos2->num_rows;
?>

<header class="main-header">
<!-- Logo -->
<a href="index.php" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><img src="dist/img/logo/logo.png" width="auto" height="30" alt=""></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><img src="dist/img/logo/logo2.png" width="auto" height="30" alt=""></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
      <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-envelope-o" id="btnmsg"></i>
          <?php 
          $resultm = $conexion->query("SELECT * FROM chats WHERE para='$yo' AND leido='0'");
          $numm = $resultm->num_rows;
          ?>
          
          <span class="label label-success"><div id="bnm"><?php echo $numm; ?></div></span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">
            <div id="hnmsj">
              
            </div>
          </li>
            <li>
              <!-- AQUI EL AJAX LANZARA RESULTADOS -->
              <div id="mensajes">
                <center>
                  <img src="dist/img/loadingcoment.gif" alt="" width="70" height="40">
                </center>
              </div>
            </li>
          <li class="footer"><a href="chats.php">Todos los mensajes</a></li>
        </ul>
      </li>
      <!-- Notifications: style can be found in dropdown.less -->
      <?php 
      $mostrarnotifi = $conexion->query("SELECT user2,tipo,fecha,id_noti FROM notificacion WHERE user1='$yo' AND visto='0'");
      $nronotifi = $mostrarnotifi->num_rows;
      ?>
      <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning"><div id="bnnotifi"><?php echo $nronotifi; ?></div></span>
        </a>
        <ul class="dropdown-menu">
          <?php 
          if ($nronotifi == 1) {
            ?>
            <center><li class="header">Tienes <?php echo $nronotifi ?> notificación nueva</li></center>
            <?php
          }else{
            ?>
            <center><li class="header">Tienes <?php echo $nronotifi ?> notificaciones nuevas</li></center>
            <?php
          }

          ?>
          <li>
            <!-- inner menu: contains the actual data -->
            <div id="notificaciones">
              <center>
                <img src="dist/img/loadingcoment.gif" alt="" width="70" height="40">
              </center>
            </div>
          </li>
          <li class="footer"><a href="#">View all</a></li>
        </ul>
      </li>
      <!-- Tasks: style can be found in dropdown.less -->

      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="avatar/<?php echo $row['foto']; ?>" class="user-image" alt="User Image">
          <span class="hidden-xs"><?php echo $row['nombre']." ".$row['apellido']; ?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="avatar/<?php echo $row['foto'] ?>" class="img-circle" alt="User Image">

            <p>
              <?php echo $row['nombre']." ".$row['apellido']; ?>
              <small>Miembro desde <?php echo $row['fecha_reg']; ?></small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-xs-6 text-center">
                <a href="#">Seguidores</a>
                <p><?php echo $numseguidores2 ?></p>
              </div>
              <div class="col-xs-6 text-center">
                <a href="#">Seguidos</a>
                <p><?php echo $numseguidos2 ?></p>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="perfil.php?id=<?php echo $_SESSION['id']; ?>&perfil=publicacionesp" class="btn btn-default btn-flat">Perfil  </a>
            </div>
            <div class="pull-right">
              <a href="salir.php" class="btn btn-default btn-flat">Cerrar sesión</a>
            </div>
          </li>
        </ul>
      </li>

    </ul>
  </div>
</nav>
</header>
