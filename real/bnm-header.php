<?php 
  include("../config/conexion.php");
  session_start();
  $yo =  $_SESSION['id'];

  $resultm = $conexion->query("SELECT * FROM chats WHERE para='$yo' AND leido='0'");
  $numm = $resultm->num_rows;

  echo $numm;
?>



