<script>
  function eliminar(id){
    if (confirm('¿Esta seguro que desea eliminar este comentario?')) {
      var datos = 'id='+id;
      $.ajax({
        type: "POST",
            url: "real/eliminarcomentario.php",
            data: datos,
            dataType:"html",
            asycn:false,
      })
      .done(function(respuesta2){
        $("#eliminado").html(respuesta2);
      })
      .fail(function(respuesta2){
        console.log('Error al eliminar comentario');
      })  
    }
  }
</script>

<?php 
  include("../config/conexion.php");
  session_start();
  $yo = $_SESSION['id'];

  $publicacion = mysqli_real_escape_string($conexion,$_POST['idp']);

  $querycoment = "SELECT * FROM comentario WHERE id_publicacion = '".$publicacion."' AND desactivado='0' ORDER BY id asc";
  $comentarios = $conexion->query($querycoment);  

  while($com = $comentarios->fetch_assoc()){

    $queryusuc = "SELECT * FROM usuario WHERE id = '".$com['id_usuario']."'";
    $usuarioc = $conexion->query($queryusuc);
    $usec = $usuarioc->fetch_assoc();
    ?>

    <div class="box-comment" id="cargarcomentario">
      <!--User image-->
      <img class="img-circle img-sm" src="avatar/<?php echo $usec['foto'];?>">

      <div class="comment-text">
        <?php
        if ($usec['verificado'] != 0) { ?>
          <span class="description" onclick="location.href='perfil.php?id=<?php echo $usec['id'];?>&perfil=publicacionesp';" style="cursor:pointer; color: red;"><?php echo $usec['nombre']." ".$usec['apellido'];?><i class="fa fa-check"></i></span>
          <span class="text-muted pull-right">
            <?php echo $com['fecha'];?>
            <?php 
            if ($com['id_usuario'] == $yo) {
              ?>
              <button type="button" title="Eliminar comentario" class="btn btn-box-tool" onclick="eliminar(<?php echo $com['id'] ?>);"><i class="fa fa-remove"></i>
              </button>
              <div id="eliminado"></div>
              <?php
            }else{
              ?>
              <button type="button" disabled="" class="btn btn-box-tool"><i class="fa fa-ellipsis-h"></i>
              </button>
              <?php              
            }
            ?>  
          </span>
        <?php
        }else{ ?>
          <span class="description" onclick="location.href='perfil.php?id=<?php echo $usec['id'];?>&perfil=publicacionesp';" style="cursor:pointer; color: red;"><?php echo $usec['nombre']." ".$usec['apellido'];?></span>
          <span class="text-muted pull-right">
            <?php echo $com['fecha'];?>
            <?php 
            if ($com['id_usuario'] == $yo) {
              ?>
              <button type="button" title="Eliminar comentario" class="btn btn-box-tool" onclick="eliminar(<?php echo $com['id'] ?>);"><i class="fa fa-remove"></i>
              </button>
              <div id="eliminado"></div>
              <?php
            }else{
              ?>
              <button type="button" disabled="" class="btn btn-box-tool"><i class="fa fa-ellipsis-h"></i>
              </button>
              <?php              
            }
            ?>  
          </span>
        <?php
        }
        ?>
        <?php echo $com['comentario'];?>
      </div>
      <!-- /.comment-text -->
    </div>
    <!-- /.box-comment -->
  <?php
  }
?>                      


