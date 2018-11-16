<?php 
	include('../config/conexion.php');

	$idp = mysqli_real_escape_string($conexion,$_POST['idp']);
	$idu = mysqli_real_escape_string($conexion,$_POST['idu']);
	$comentario = mysqli_real_escape_string($conexion,$_POST['comentario']);

	$buscarpubli = ($conexion->query("SELECT id_usuario FROM publicacion WHERE id='$idp'"))->fetch_assoc();
	$userpubli = $buscarpubli['id_usuario'];

	if ($userpubli != $idu) {
		$comentnotifi = $conexion->query("INSERT INTO notificacion (user1,user2,tipo,id_noti,fecha) VALUES('$userpubli','$idu',2,'$idp',now())");

        if ($comentnotifi) {
          ?>
          <script>console.log('Notificacion de comentario agregada')</script>
          <?
        }else{
          ?>
          <input type="hidden" id="errornoti" value="<?php echo $conexion->error ?>">
          <script>
            var errornoti = document.getElementById('errornoti').value;
            console.log(errornoti);
          </script>
          <?php
        }		
	}


	$query = $conexion->query("INSERT INTO comentario (id_usuario,comentario,fecha,id_publicacion) VALUES ('$idu','$comentario',now(),'$idp')");

	if ($query) {
		?>
		<script>console.log('Comentario guardado');</script>
		<?php
	}else{
		?>
		<script>console.log('Error al comentar');</script>
		<?php		
	}
	
?>