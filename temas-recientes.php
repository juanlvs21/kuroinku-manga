<?php 
    include('config/conexion.php');

    $querytemas = $conexion->query("SELECT id,id_usuario,fecha,contenido,titulo FROM publicacion WHERE desactivada='0' ORDER BY fecha DESC LIMIT 10");


    while ($temas = $querytemas->fetch_assoc()) {
        $id = $temas['id'];
        $iduser = $temas['id_usuario'];
        $usertema = ($conexion->query("SELECT nombre,apellido,foto,admin,editor FROM usuario WHERE id='$temas[id_usuario]'"))->fetch_assoc();

        ?>
        <div class="media comment-box">
            <div class="media-left">
                <a href="#">
                    <img class="user-photo" src="avatar/<?php echo $usertema['foto'] ?>">
                </a>
            </div>
            <script>
            function eliminar(id){
                if (confirm('¿Esta seguro que desea eliminar esta publicación?')) {
                    var datos = 'id='+id;
                    
                    $.ajax({
                      type: "POST",
                          url: "real/eliminarpublicacion.php",
                          data: datos,
                          dataType:"html",
                          asycn:false,
                    })
                    .done(function(respuesta2){
                      $("#eliminado").html(respuesta2);
                    })
                    .fail(function(respuesta2){
                      console.log('error');
                    })  
                }
            }
            </script>
            <div class="media-body">
                <h4 class="media-heading">
                    <?php echo $temas['titulo'] ?>

                    <small><?php echo $usertema['nombre']." ".$usertema['apellido'] ?></small>
                    
                    <span class="text-muted pull-right">
                        <?php echo $temas['fecha'];?>
                        <?php 
                        $yo = $_SESSION['id'];
                        if ($yo == $iduser) {
                            ?>
                            <i onclick="eliminar('<?php echo $id ?>')" style="cursor: pointer" class="fa fa-close"></i>
                            <div id="eliminado"></div>
                            <?php
                        }else{
                            ?>
                            <i class="fa fa-ellipsis-h"></i>
                            <?php
                        }
                        ?>
                    </span>
                    
                </h4>
                <p>
                    <?php echo $temas['contenido'] ?>
                </p>
            </div>
        </div>
        <hr>

        <?php
    }


?>

<div>
    <center>
        <p><a href="temas.php" style="color: red">Ver todos los temas</a></p>
    </center>
</div>