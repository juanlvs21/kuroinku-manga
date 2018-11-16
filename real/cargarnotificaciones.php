<?php 
  include("../config/conexion.php");
  session_start();
  $usuario =  $_SESSION['usuario'];
  $query = "SELECT * FROM usuario WHERE usuario='$usuario'";
  $result = $conexion->query($query);
  $row = $result->fetch_assoc();
  $yo = $row['id'];

  $queryn = "SELECT user2,tipo,fecha,id_noti FROM notificacion WHERE user1='$yo' AND visto='0' ORDER BY fecha DESC LIMIT 8";
  $resultn = $conexion->query($queryn);

  if ($resultn->num_rows > 0) {

    ?>
    <ul class="menu">
    <?php

    while ($rownotifi = $resultn->fetch_assoc()) {
      $user2 = $rownotifi['user2'];
      $usernotifi = ($conexion->query("SELECT nombre,apellido FROM usuario WHERE id='$user2'"))->fetch_assoc();

      if ($rownotifi['tipo'] == 1) {
        ?>
        <li>
          <a href="perfil.php?id=<?php echo $user2 ?>&perfil=publicacionesp" title="<?php echo $usernotifi['nombre'].' '.$usernotifi['apellido'].' ahora te seguirte' ?>">
            <i class="fa fa-user-plus text-aqua"></i><?php echo $usernotifi['nombre'].' '.$usernotifi['apellido'].' ahora te seguirte' ?>
          </a>
        </li>
        <?php
      }

      if ($rownotifi['tipo'] == 2) {
        ?>
        <li>
          <a href="publicacion.php?id=<?php echo $rownotifi['id_noti'] ?>" title="<?php echo $usernotifi['nombre'].' '.$usernotifi['apellido'].' ha comentado tu publicación' ?>">
            <i class="fa fa-comment text-green"></i><?php echo $usernotifi['nombre'].' '.$usernotifi['apellido'].' ha comentado tu publicación' ?>
          </a>
        </li>
        <?php
      }

    }

    ?>
    <!-- end message -->
    </ul>
    <?php
  }else{
    ?>
    <center><p>Sin notificaciones nuevas</p></center>
    <?php
  }
?>
