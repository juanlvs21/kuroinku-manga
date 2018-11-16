<?php 
  include("../config/conexion.php");
  ini_set('error_reporting',0);
  session_start();
  
  $yo =  $_SESSION['id'];

  $mostrarnotifi = $conexion->query("SELECT user2,tipo,fecha,id_noti FROM notificacion WHERE user1='$yo' AND visto='0'");
  $nronotifi = $mostrarnotifi->num_rows;

  echo $nronotifi;

?>



