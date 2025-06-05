<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AGPA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet">  
  <script src="assets/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="assets\imagen\sello.png"  alt="" height="120" width="120">
  </div>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <a href="/" class="brand-link">
      <img src="assets\imagen\logo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
    </a>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside style="background-color:#b90606;" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <span  style="font-family: 'Seymour One', sans-serif;" class="brand-text font-weight-light">AGPA</span>
    </a>
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a style="color: white;" href="#" class="d-block"><?php echo $_SESSION['user']->nombre; ?></a>
        </div>
      </div>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a style="color: white;" href="#" class="d-block"><?php echo $_SESSION['user']->username; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php
                    if ($_SESSION['user']->rol == 1) {
                    ?> <li class="nav-item">
                    <a style="color: white;" href="/" class="nav-link">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Tablero
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=Convocatorias" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Convocatorias
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=proyectos" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Proyectos
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=feria" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Ferias
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=docentes" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Docentes
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=usuarios" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Estudiantes
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=historial" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Historial
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=Proyectos&a=Editar" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Registrar Proyectos
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=logout" class="nav-link">
                      <i class="nav-icon fas fa-arrow-left"></i>
                      <p>
                        Cerrar sesión
                      </p>
                    </a>
                  </li>

                  <?php
                    } else if ($_SESSION['user']->rol == 3) {
                    ?> <li class="nav-item">
                    <a style="color: white;" href="/" class="nav-link">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Tablero
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=convocatorias" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Convocatorias
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=proyectos" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Proyectos
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=feria" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Ferias
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=logout" class="nav-link">
                      <i class="nav-icon fas fa-arrow-left"></i>
                      <p>
                        Cerrar sesión
                      </p>
                    </a>
                  </li>
                  
                    <?php
                    } else {
                    ?> <li class="nav-item">
                    <a style="color: white;" href="/" class="nav-link">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Tablero
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=convocatorias" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Convocatorias
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=feria" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Ferias
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=usuarios" class="nav-link">
                      <i class="nav-icon fas fa-folder"></i>
                      <p>
                        Estudiantes
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" href="/?c=logout" class="nav-link">
                      <i class="nav-icon fas fa-arrow-left"></i>
                      <p>
                        Cerrar sesión
                      </p>
                    </a>
                  </li>
                    <?php
                    }
                    ?>         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">