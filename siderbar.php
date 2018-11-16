<?php 
    //Cargando numero de mensajes no leidos
    $querynumchat = $conexion->query("SELECT * FROM chats WHERE para='$yo' AND leido='0'");
    $rownumchat = $querynumchat->fetch_assoc();
    $numchats = $querynumchat->num_rows;
?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="avatar/<?php echo $row['foto'] ?>" class="img-circle" style="height: 40px; width:40px;" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><a href="perfil.php?id=<?php echo $_SESSION['id']; ?>&perfil=publicacionesp"><?php echo $row['nombre']?></a></p>
        <p><a href="perfil.php?id=<?php echo $_SESSION['id']; ?>&perfil=publicacionesp"><?php echo $row['apellido']?></a></p>
        <!--a href="#"><i class="fa fa-circle text-success"></i> En linea </a-->
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Buscar (Manga/Persona)">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Menu de navegacion</li>
      <li class="active">
        <a href="index.php">
          <i class="fa fa-home"></i> <span>Inicio</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <li>
        <a href="noticias.php?noticia=nmangas">
          <i class="fa fa-newspaper-o"></i> <span>Noticias</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>

      <?php 
      $resultm2 = $conexion->query("SELECT * FROM chats WHERE para='$yo' AND leido='0'");
      $numm2 = $resultm2->num_rows;
      ?>  
          
      <li>
        <a href="chats.php">
          <i class="fa fa-comments"></i> <span>Chat</span>
          <span class="pull-right-container">
              <span class="label label-danger pull-right"><div id="bnm2"><?php echo $numm2; ?></div></span>
          </span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder"></i>
          <span>Mangas</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right"><?php //Numero para mostrar notificacion ?></span>
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="mangas.php"><i class="fa fa-folder-open"></i> Todos</a></li>
          <li><a href="favoritos.php"><i class="fa fa-bookmark"></i> Favoritos</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-group"></i>
          <span>Grupos</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-users"></i> Miembro</a></li>
          <li><a href="#"><i class="fa fa-user-plus"></i> Creados</a></li>
        </ul>
      </li>
      <?php
        if ($row['admin'] == 1) { ?>
          <li>
            <a href="usuarios.php">
              <i class="fa fa-vcard"></i> <span>Usuarios</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>
        <?php
        }
      ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
