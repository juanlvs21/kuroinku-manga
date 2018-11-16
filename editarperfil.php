<div class="box box-widget col-md-10">  
  <br>
  <!-- EDITAR INFORMACION PERSONAL-->
  <div class="box box-widget">
    <div class="box-header">
      <center>
        <i class="fa fa-address-card"></i>
        <h3 class="box-title">Datos Personales</h3>
      </center>
    </div>
    <div class="box-body border-radius-none">
     <form action=""  method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nombre">Nombre: </label>
          <input type="text" class="form-control" placeholder="Ingrese Nombre" name="nombre" id="nombre" value="<?php echo $rowget['nombre']?>">         
        </div>  

        <div class="form-group">
          <label for="apellido">Apellido: </label>
          <input type="text" class="form-control" placeholder="Ingrese Apellido" name="apellido" id="apellido" value="<?php echo $rowget['apellido']?>">         
        </div>

        <div class="form-group">
          <?php 
            $fecha = date_format((new DateTime($rowget['fecha_nac'])), 'Y-m-d');
          ?>
          <label for="fecha_nac">Fecha de nacimiento: </label>
          <input type="date" class="form-control" name="fecha_nac" id="fecha_nac" value="<?php echo $fecha?>">
        </div>
          
        <div class="form-group">
          <label for="sexo">Sexo:</label>
          <select class="form-control" name="sexo" id="sexo">
            <?php 
            if ($rowget['sexo'] == 'Masculino') { ?>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
              <option value="Prefiero no decirlo">Prefiero no decirlo</option>
            <?php
            }
            ?>
            <?php 
            if ($rowget['sexo'] == 'Femenino') { ?>
              <option value="Femenino">Femenino</option>
              <option value="Masculino">Masculino</option>
              <option value="Prefiero no decirlo">Prefiero no decirlo</option>
            <?php
            }
            ?>
            <?php 
            if ($rowget['sexo'] == 'Prefiero no decirlo') { ?>
              <option value="Prefiero no decirlo">Prefiero no decirlo</option>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            <?php
            }
            ?>
          </select>         
        </div>

        <div class="form-group">
          <label for="direccion">Direccion: </label>
          <input type="text" class="form-control" name="direccion" placeholder="Ingrese Direccion" id="direccion" value="<?php echo $rowget['direccion']?>">         
        </div> 

        <div class="form-group">
          <label for="correo">Correo Electronico: </label>
          <input type="text" class="form-control" name="correo" placeholder="Ingrese Correo Electronico" id="correo" value="<?php echo $rowget['correo']?>">         
        </div>  

        <div class="form-group">
          <label for="correo">Estado Correo Electronico: </label>
          <?php 
          if ($rowget['verifi_correo'] == 0) { ?>
            <p class="btn btn-danger btn-sm">Verificar</p>
          <?php
          }
          if ($rowget['verifi_correo'] == 1) { ?>
            <button  type="button" class="btn btn-success btn-sm">Verificado</button>
          <?php
          }
          ?>        
        </div>   
        <center><button type="submit" class="btn btn-primary" onclick="editarpersonal(<?php echo $yo ?>)" name="btnpersonal" id="btnpersonal">Guardar</button></center>
      </form>
      <div id="guardado1"></div>
      <input type="hidden" id="id" value="<?php echo $yo ?>">
      <script>
        function editarpersonal(id){
          event.preventDefault();
          var nombre = document.getElementById("nombre").value;
          var apellido = document.getElementById("apellido").value;
          var fecha_nac = document.getElementById("fecha_nac").value;
          var sexo = document.getElementById("sexo").value;
          var direccion = document.getElementById("direccion").value;
          var correo = document.getElementById("correo").value;
          
          var datos = 'id='+id;
          datos += '&nombre='+nombre;
          datos += '&apellido='+apellido;
          datos += '&fecha_nac='+fecha_nac;
          datos += '&sexo='+sexo;
          datos += '&direccion='+direccion;
          datos += '&correo='+correo;

          $.ajax({
              type: "POST",
              url: "real/actualizarpersonal.php",
              data: datos,
              dataType:"html",
              asycn:false,
          })
          .done(function(respuesta2){
              $("#guardado1").html(respuesta2);
          })
          .fail(function(respuesta2){
              console.log('error');
          })          

        }
      </script>

      <?php 
      if (isset($_POST['btnpersonal'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha_nac = $_POST['fecha_nac'];
        $sexo = $_POST['sexo'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];


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
      }
      ?>
      <br>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /FIN EDITAR INFORMACION PERSONAL-->
  
  <!-- EDITAR REDES SOCIALES-->
  <div class="box box-widget">
    <div class="box-header">
      <center>
        <i class="fa fa-address-card"></i>
        <h3 class="box-title">Redes Sociales</h3>
      </center>
    </div>
    <div class="box-body border-radius-none">
     <form action="" method="POST">
        <div class="form-group">
          <label for="facebook">Facebook: </label>
          <input type="text" class="form-control" placeholder="Ingrese Facebook" name="facebook" id="facebook" value="<?php echo $rowget['facebook']?>">         
        </div>  

        <div class="form-group">
          <label for="twitter">Twitter: </label>
          <input type="text" class="form-control" placeholder="Ingrese Twitter" name="twitter" id="twitter" value="<?php echo $rowget['twitter']?>">         
        </div>

        <div class="form-group">
          <label for="instagram">Instagram: </label>
          <input type="text" class="form-control" placeholder="Ingrese Instagram" name="instagram" id="instagram" value="<?php echo $rowget['instagram']?>">         
        </div>

        <center><button type="submit" class="btn btn-primary" onclick="editarredes(<?php echo $yo ?>)" id="btnredes" name="btnredes">Guardar</button></center>
      </form>
      <script>
        function editarredes(id){
          event.preventDefault();
          var facebook = document.getElementById("facebook").value;
          var twitter = document.getElementById("twitter").value;
          var instagram = document.getElementById("instagram").value;
          
          var datos = 'id='+id;
          datos += '&facebook='+facebook;
          datos += '&twitter='+twitter;
          datos += '&instagram='+instagram;

          $.ajax({
              type: "POST",
              url: "real/actualizarredes.php",
              data: datos,
              dataType:"html",
              asycn:false,
          })
          .done(function(respuesta2){
              $("#guardado1").html(respuesta2);
          })
          .fail(function(respuesta2){
              console.log('error');
          })          

        }
      </script>
      <?php 
      if (isset($_POST['btnredes'])) {
        $facebook = $_POST['facebook'];
        $twitter = $_POST['twitter'];
        $instagram = $_POST['instagram'];

        $query = $conexion->query("UPDATE usuario SET facebook='$facebook', twitter='$twitter', instagram='$instagram' WHERE id='$yo'");

        if ($query) { ?>
          <script> 
          console.log('Redes sociales actualizadas');
          var id = document.getElementById('id').value;
          var url = 'perfil.php?id='+id;
          url += '&perfil=editarperfil';
          location.href = url;
          </script>
        <?php
        }else{ ?>
          <script> console.log('Error al actualizar las redes sociales'); </script>
        <?php
        }
      }
      ?>     
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /FIN EDITAR REDES SOCIALES-->

  <!-- EDITAR REDES SOCIALES-->
  <div class="box box-widget">
    <div class="box-header">
      <center>
        <i class="fa fa-address-card"></i>
        <h3 class="box-title">Contraseña</h3>
      </center>
    </div>
    <div class="box-body border-radius-none">
      <center>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalcontra">Cambiar contraseña</button>
      </center>
      <script>
        function editarredes(id){
          event.preventDefault();
          var facebook = document.getElementById("facebook").value;
          var twitter = document.getElementById("twitter").value;
          var instagram = document.getElementById("instagram").value;
          
          var datos = 'id='+id;
          datos += '&facebook='+facebook;
          datos += '&twitter='+twitter;
          datos += '&instagram='+instagram;

          $.ajax({
              type: "POST",
              url: "real/actualizarredes.php",
              data: datos,
              dataType:"html",
              asycn:false,
          })
          .done(function(respuesta2){
              $("#guardado1").html(respuesta2);
          })
          .fail(function(respuesta2){
              console.log('error');
          })          

        }
      </script>
      <?php 
      if (isset($_POST['btnredes'])) {
        $facebook = $_POST['facebook'];
        $twitter = $_POST['twitter'];
        $instagram = $_POST['instagram'];

        $query = $conexion->query("UPDATE usuario SET facebook='$facebook', twitter='$twitter', instagram='$instagram' WHERE id='$yo'");

        if ($query) { ?>
          <script> 
          console.log('Redes sociales actualizadas');
          var id = document.getElementById('id').value;
          var url = 'perfil.php?id='+id;
          url += '&perfil=editarperfil';
          location.href = url;
          </script>
        <?php
        }else{ ?>
          <script> console.log('Error al actualizar las redes sociales'); </script>
        <?php
        }
      }
      ?>     
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /FIN EDITAR REDES SOCIALES-->  
  <br>  
</div>

  <!--MODAL CAMBIAR CONTRASEÑA -->
      <div class="modal fade" id="modalcontra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!-- si quitas data-dismiss="modal" no se cierra el modal con un alert-->
                <center><h4>Cambiar contraseña</h4></center>
              </div>
              <script>
                function cambiarcontra(){

                  event.preventDefault();
                  var contraactual = document.getElementById("contraactual").value;
                  var nuevacontra = document.getElementById("nuevacontra").value;
                  var repetircontra = document.getElementById("repetircontra").value;

                  var datos = 'contraactual='+contraactual;
                  datos += '&nuevacontra='+nuevacontra;
                  datos += '&repetircontra='+repetircontra;

                  $.ajax({
                      type: "POST",
                      url: "real/cambiarcontra.php",
                      data: datos,
                      dataType:"html",
                      asycn:false,
                      success: function(){
                        console.log('Datos enviados');
                      }
                  })
                  .done(function(respuesta2){
                      console.log('Datos exitosos');
                      $("#resultado").html(respuesta2);
                      $("#contraactual").val("");
                      $("#nuevacontra").val("");
                      $("#repetircontra").val("");
                      $('#repetir').removeClass('has-error');
                      $('#repetir').removeClass('has-success');
                      $('#iguales').addClass('hidden');
                      $('#diferentes').addClass('hidden');                      
                  })
                  .fail(function(respuesta2){
                      console.log('Error al cambiar contraseña');
                  })
                }
              </script>
              <div class="modal-body"><!--#Body modal-->
                <form action="" method="post">
                  <div class="form-group">
                    <label for="contraactual">Contraseña actual</label>
                    <input type="password" class="form-control" id="contraactual" name="contraactual" placeholder="Contraseña actual" required >
                    <div id="resultado"></div>
                  </div>      
                  <div class="form-group">
                    <label for="nuevacontra">Nueva contraseña</label>
                    <input type="password" class="form-control" id="nuevacontra" name="nuevacontra" placeholder="Contraseña nueva" required>
                  </div>
                  <div class="form-group" id="repetir">
                    <label for="repetircontra">Repetir contraseña</label>
                    <input type="password" class="form-control" id="repetircontra" name="repetircontra" placeholder="Repetir contraseña" required>
                    <center>
                      <small id="iguales" class="hidden" style="color: green">Contraseñas coinciden</small>
                      <small id="diferentes" class="hidden" style="color: red">Contraseñas no coinciden</small>
                    </center>
                  </div>
                  <div class="form-group">
                    <center><button type="submit" class="btn btn-primary" id="btncontra" onclick="cambiarcontra()" name="btncontra">Cambiar contraseña</button></center>
                  </div>                  
                </form>            
              </div><!--/#Body modal editar datos-->

              <div class="modal-footer">
                <button type="button" name="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
              </div>

            </div>
        </div>
      </div>
  <!-- FIN MODAL CAMBIAR CONTRASEÑA -->



