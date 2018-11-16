<?php 
	include('../config/conexion.php');
	session_start();

	$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
	$contra = mysqli_real_escape_string($conexion, md5($_POST['contra']));

	$query = $conexion->query("SELECT id,usuario,betado FROM usuario WHERE usuario='$usuario' AND contra='$contra'");
	$row = $query->num_rows;
	$result = $query->fetch_assoc();

	if ($row > 0) {
		if ($result['betado'] == 1) {
			?>
            <br>
            <div class="alert alert-danger alert-dismissible">
            	<button type="button" class="close" name="button2" data-dismiss="alert" aria-hidden="true">&times;</button>
            	<center>Lo sentimos <?php $row['nombre']." ".$row['apellido'] ?> usted ha sido betado hasta nuevo aviso</center>
            </div>
			<?php
		}else{
	        $_SESSION['usuario'] = $result['usuario'];
	        $_SESSION['id'] = $result['id'];
	        ?>
    		<center><img src="dist/img/loading.gif" id="loadingregister" alt="" width="100" height="100" border="0"></center>	        
	        <script type="text/javascript">
	        	setTimeout(function(){
	            	location.href = 'index.php'
	            },1000);
	        </script>
	        <?php			
		}
	}else{
		?>
        <br>
        <div class="alert alert-danger alert-dismissible">
        	<button type="button" class="close" name="button2" data-dismiss="alert" aria-hidden="true">&times;</button>
        	<center>Usuario/Contraseña incorrectos</center>
        </div>
		<?php	
	}
?>
