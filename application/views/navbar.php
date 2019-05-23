  <style type="text/css">
    body{
      background-image: url(http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg);
      background-repeat: no-repeat;
      background-attachment: fixed;
      overflow: scroll;
    }
  </style>
    <nav class="navbar navbar-expand-lg navbar-light shadow p-3 mb-1 bg-white rounded position " style="margin-top: 30px;
      margin-left: 50px;
      margin-right: 50px;
      margin-bottom: 100px;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse nav justify-content-center" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="<?php echo base_url();?>">SIPLAS</a>
    <ul class="nav">
      <li>
         <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Reuniones
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li class="nav-item active">
              <a class=""  href="<?php echo base_url();?>index.php/newReunion/index">Crear una reunión</a>
            </li>
            <li><a href="<?php echo base_url();?>index.php/newReunion/listarReuniones">Listar Reuniones</a></li>
          </ul>
        </div> 
      </li>
      <li>
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Usuarios
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li>
              <a href="<?php echo base_url(); ?>index.php/altaInvitado">Registrar usuario</a>
            </li>
            <li class="">
              <a href="#">Listar todos los usuarios</a>
            </li>
          </ul>
        </div>
      </li>
      
       <li class="nav-item">
        <a class="nav-link" href="#">Agregar más...</a>
      </li>
      <li>
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php
            echo $this->session->userdata('usuario');
          ?>
           SIPLAS
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li class="nav-item">
              <a class="dropdown-item nav-link" href="<?php echo base_url(); ?>index.php/logout">Cerrar sesión</a>
            </li>
          </ul>
        </div>
      </li>
      
      
    </ul>
  </div>
</nav>