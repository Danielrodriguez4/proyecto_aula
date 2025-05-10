<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AGPA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
<link href="https://fonts.googleapis.com/css2?family=Seymour+One&display=swap" rel="stylesheet"> 
</head>

<body background="assets/imagen/u.jpg"  class="hold-transition register-page">
    <div class="register-box">
        <div style="border-color:white; background-color:#b90606;" class="card card-outline card-primary">
            <div class="card-header text-center">
             <a style="color: white;" href="/" class="brand-link">
                <img src="assets\imagen\logo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span  style="font-family: 'Seymour One', sans-serif;" class="brand-text font-weight-light">AGPA</span>
             </a>
            </div>
            <div class="card-body">
                <p style="color: white;" class="login-box-msg">Ingrese sus Datos</p>

                <form action="?c=registro&a=Registrar" method="post">
                    <div class="input-group mb-3">
                        <input type="number" name="code" required class="form-control" placeholder="Codigo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                     <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" required placeholder="Nombres">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="last_name" class="form-control" required placeholder="Apellidos">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="telephone" class="form-control" required placeholder="Telefono">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="sexo" class="form-control">
                          <option value="m" selected>Masculino</option>
                          <option value="f">Femenino</option>
                        </select>
                      </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" required placeholder="Correo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" required placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-6">
                            
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <button style="border-color:white; background-color:#b90606;" type="submit" class="btn btn-primary btn-block">Registrarse</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>

    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/adminlte.min.js"></script>
</body>

</html>