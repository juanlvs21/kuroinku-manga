<?php 

  include("config/conexion.php");

  session_start();
  
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

?>