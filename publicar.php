<?php 

  include("config/conexion.php");

  session_start();

  $publicacion = mysqli_real_escape_string($conexion,$_POST['publicacion']);
  $ruta = 'publicaciones/';
  $destino = basename($_FILES['archivo']['name']);

  /*$img_query = "SHOW TABLE STATUS WHERE `Name` = 'publicacion'";
  $img_result = $conexion->query($img_query);
  $img_data = $img_result->fetch_assoc();
  $img_next = $img_data['Auto_increment'];

  $alea = substr(strtoupper(md5(microtime(true))), 0,12);
  $code = $img_next.$alea;

  $img_type = 'jpg';
  $rfoto = $_FILES['foto']['tmp_name'];
  $name = $code.".".$img_type;

  if(is_uploaded_file($rfoto)){

    $img_destino = "publicaciones/".$name;
    $img_nombre = $name;
    copy($rfoto, $img_destino);

  }else{
    $img_nombre = '';
  }*/

  /*$ruta = 'publicaciones/';
  $code = substr(strtoupper(md5(microtime(true))), 0,12);
  $name = $code.".".$img_type;
  $destino = basename($_FILES['foto']['name']);
  $rfoto = $_FILES['foto']['tmp_name'];*/

  function validar($file){
    if (($file['archivo']['type']!=='image/jpeg')&&($file['user-file']['type']!=='image/png')){
      return false;
    }
    return true;
  }

  $subir_query = "INSERT INTO publicacion (id_usuario,fecha,contenido,img) values ('".$_SESSION['id']."',now(),'$publicacion','$destino')";
  $subir_result = $conexion->query($subir_query);
  if ($subir_result) {
    if (validar($_FILES)) {
      if (move_uploaded_file($_FILES['archivo']['tmp_name'], $destino)) {
        //header('Location: index.php');
      }
    }else{
      //header('Location: index.php');
    }
  }else{
      echo "Error Al guardar";
  }

?>