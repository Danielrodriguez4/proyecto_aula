<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AGPA</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/icheck-bootstrap/icheck-bootstrap.min.css"> 
<link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>
<body background="assets/imagen/ufps.jpg" class="hold-transition login-page">
<div class="login-box">
  <div style="background-color:#b90606; border-color:white;" class="card card-outline card-primary">
    <div class="card-header text-center">
    <a style="color: white;" href="/" class="brand-link">
      <img src="assets\imagen\logo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span  style="font-family: 'Seymour One', sans-serif;" class="brand-text font-weight-light">AGPA</span>
    </a>
    </div>
    <div class="card-body">
      <p style="color: white;" class="login-box-msg">Ingrese sus datos para iniciar sesión</p>
      <p class="login-box-msg"><?php echo $e; ?></p>
      <form  action="?c=login&a=Verificar" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" required class="form-control" placeholder="Correo">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" required class="form-control" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 offset-md-6">
            <button style="border-color: white; background-color:#b90606;" style="background-color:#b90606;" type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
          </div>
        </div>
      </form>
      <p class="mb-0">
        <a style="color: white;" href="?c=registro" class="text-center">Registrarse</a>
      </p>
    </div>
  </div>
</div>

<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/adminlte.min.js"></script>
</body>
</html>