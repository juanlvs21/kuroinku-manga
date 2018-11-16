<?php 
  include('../config/conexion.php');

  $yo = $_POST['id'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $fecha_na = $_POST['fecha_nac'];
  $sexo = $_POST['sexo'];
  $direccion = $_POST['direccion'];
  $correo = $_POST['correo'];

  ?>
  <input type="hidden" id="id" value="<?php echo $yo ?>">
  <?php

  $fecha_nac = date_format((new DateTime($fecha_na)), 'Y-m-d');
  $query = $conexion->query("UPDATE usuario SET nombre='$nombre', apellido='$apellido', fecha_nac='$fecha_nac', sexo='$sexo', direccion='$direccion', correo='$correo' WHERE id='$yo'");

  if ($query) { ?>
    <script> 
      console.log('Datos personales actualizados');
      var id = document.getElementById('id').value;
      var url = 'perfil.php?id='+id;
      url += '&perfil=editarperfil';
      location.href = url;
    </script>
  <?php
  }else{ ?>
    <script> console.log('Error al actualizar los datos'); </script>
  <?php
  }
?>