<?php 
  include('../config/conexion.php');

  $yo = $_POST['id'];
  $facebook = $_POST['facebook'];
  $twitter = $_POST['twitter'];
  $instagram = $_POST['instagram'];;

  ?>
  <input type="hidden" id="id" value="<?php echo $yo ?>">
  <?php

  $query = $conexion->query("UPDATE usuario SET facebook='$facebook', twitter='$twitter', instagram='$instagram' WHERE id='$yo'");

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