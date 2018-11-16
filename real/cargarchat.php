<?php 
  include("../config/conexion.php");
  session_start();

  $user = mysqli_real_escape_string($conexion,$_POST['usuario']);
  $sess = $_SESSION['id'];
  $salida = "";

  $chats = $conexion->query("SELECT * FROM chats WHERE de = '$user' AND para = '$sess' OR de = '$sess' AND para = '$user' order by id_cha DESC");

  if ($chats->num_rows > 0) {
    while($ch = $chats->fetch_assoc()){
      if($ch['de'] == $user) {$var = $user;} else {$var = $sess;}
      $usere = $conexion->query("SELECT * FROM usuario WHERE id = '$var'");
      $us = $usere->fetch_assoc();
      $fecha = date_format((new DateTime($ch['fecha'])), 'H:i d-m-Y');
      list($fech,$hor) = explode(" ", $fecha);
      $f_h = $hor." | ".$fech;

      if ($ch['de'] == $user) {
        ?>
        <div class='direct-chat-msg'>
          <div class='direct-chat-info clearfix'>
            <span class='direct-chat-name pull-left'><?php echo $us['nombre']." ".$us['apellido'] ?></span>
            <span class='direct-chat-timestamp pull-right'><?php echo $f_h; ?></span>
          </div>
          <img class='direct-chat-img' src='avatar/<?php echo $us['foto'] ?>'><!-- /.direct-chat-img -->
          <div class='direct-chat-text'>
            <?php echo $ch['mensaje'] ?>
          </div>
        </div>
        <?php
      } elseif ($ch['para'] == $user) {
        ?>
        <div class='direct-chat-msg right'>
          <div class='direct-chat-info clearfix'>
            <span class='direct-chat-name pull-right'><?php echo $us['nombre']." ".$us['apellido'] ?></span>
            <span class='direct-chat-timestamp pull-left'><?php echo $f_h; ?></span>
          </div>
          <img class='direct-chat-img' src='avatar/<?php echo $us['foto'] ?>' alt='Message User Image'>
          <div class='direct-chat-text'>
            <?php echo $ch['mensaje'] ?>
          </div>
        </div>
        <?php
      }
    }
  }

?>