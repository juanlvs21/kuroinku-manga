<?php 
  include("../config/conexion.php");
  session_start();
  $usuario =  $_SESSION['usuario'];
  $query = "SELECT * FROM usuario WHERE usuario='$usuario'";
  $result = $conexion->query($query);
  $row = $result->fetch_assoc();
  $yo = $row['id'];

  $querym = "SELECT * FROM chats WHERE para='$yo' AND leido=0 GROUP BY de ORDER BY id_cha DESC";

  $resultm = $conexion->query($querym);

  $repetido  = "";

  if ($resultm->num_rows > 0) {

    ?>
    <ul class="menu">
    <?php

    while ($fila = $resultm->fetch_assoc()) {
      $de = $fila['de'];
      $queryu = $conexion->query("SELECT * FROM usuario WHERE id='$de'");
      $resultu = $queryu->fetch_assoc();
      $fecha = date_format((new DateTime($fila['fecha'])), 'd-m-Y');

      ?>
      <li><!-- start message -->
        <a href="chat.php?usuario=<?php echo $de ?>&leido=1">
          <div class="pull-left">
            <img src="avatar/<?php echo $resultu['foto']?>" class='img-circle' alt='User Image'>
          </div>
          <h4>
            <p><?php echo $resultu['nombre'].' '.$resultu['apellido'] ?></p>
            <small><i class='fa fa-clock-o'></i><?php echo $fecha ?></small>
          </h4>
          <p><?php echo $fila['prev'] ?></p>
        </a>
      </li>
      <?php

    }

    ?>
    <!-- end message -->
    </ul>
    <?php
  }else{
    ?>
    <center><p>Sin mensajes nuevos</p></center>
    <?php
  }
?>



