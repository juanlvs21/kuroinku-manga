<?php

    include("../config/conexion.php");

	function validar($file){
		return true;
	}

	if (validar($_FILES)) {
		$ruta = 'img/';
		$fecha = $_POST['fecha'];
		$lugar = $_POST['lugar'];
		$categoria = $_POST['categoria'];
		$descripcion = $_POST['descripcion'];
		$fotografo = $_POST['fotografo'];
		$destinoimg = "../".$ruta.basename($_FILES['fotografia']['name']);
		$destinosql = $ruta.basename($_FILES['fotografia']['name']);

		$query = "INSERT INTO fotografia(img,fecha,lugar,categoria,descripcion,user_fotografo) VALUES('$destinosql','$fecha','$lugar','$categoria','$descripcion','$fotografo')";

		$resul = $conexion->query($query);

		if ($resul) {
			if (move_uploaded_file($_FILES['fotografia']['tmp_name'], $destinoimg)){
				header('Location: panelf.php');
			}
		}else{
				echo "Error Al guardar";
		}
	}else{
		header('Location: subir.php');
	}
?>


<?php
if(isset($_POST['publicar']))
{
  $publicacion = mysqli_real_escape_string($conexion,$_POST['publicacion']);

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

  $ruta = 'publicaciones/';
  $code = substr(strtoupper(md5(microtime(true))), 0,12);
  $name = $code.".".$img_type;
  $destino = basename($_FILES['foto']['name']);
  $rfoto = $_FILES['foto']['tmp_name'];

  $subir_query = "INSERT INTO publicacion (id_usuario,fecha,contenido) values ('".$_SESSION['id']."',now(),'$publicacion')";
  $subir_result = $conexion->query($subir_query);

  if ($subir_result) {
    echo '<script>window.location="inicio.php"</script>';
    /*if (move_uploaded_file($_FILES['foto']['tmp_name'], $destino)){
      echo '<script>window.location="inicio.php"</script>';
    }*/
  }else{
      echo "Error Al guardar";
  }

}
?>
