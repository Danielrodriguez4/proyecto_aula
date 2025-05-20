<section class="content-header">
  <div class="container-fluid">
    <div class="row card-header">
      <div class="col-sm-6 ">
        <img src="assets/imagen/h.png" alt="Encabezado" style="opacity: .8;" height="250" width="1000">
      </div>
    </div>
  </div>
</section>

<div class="container-header">
    <h2>Convocatorias de Ferias y Proyectos de Aula</h2>
</div>
</br>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="input-group input-group-sm" style="width: 150px;">

                </div>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <?php
                        if ($_SESSION['user']->rol == 1) {
                            echo '<a href="?c=Convocatorias&a=Editar" style="border-color:white; background-color:#b90606;" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>Nuevo convocatoria</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-sm-6"> <!-- /.card-header -->
            <div class="card-body table-responsive p 0">
                <div class="register-box">
                    <div style="border-color:white; background-color:#b90606;" class="card card-outline card-primary">
                        <div class="card-header text-center">
                            <a style="color: white;" href="/" class="brand-link">
                                <img src="assets\imagen\logo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                                <span style="font-family: 'Seymour One', sans-serif;" class="brand-text font-weight-light">AGPA</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <p style="color: white;" class="login-box-msg">X </p>
                        </div>
                        <div>
                            <a style="border-color:white; background-color:#b90606;" type="submit" href="/?c=proyectos" class="btn btn-primary btn-block">Registrar Ferias</a>
                        </div>
                    </div>
                </div>  
            </div>
        </div>

        <div class="col-sm-6"> <!-- /.card-header -->
            <div class="card-body table-responsive p 0">
                <div class="register-box">
                    <div style="border-color:white; background-color:#b90606;" class="card card-outline card-primary">
                        <div class="card-header text-center">
                            <a style="color: white;" href="/" class="brand-link">
                                <img src="assets\imagen\logo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                                <span style="font-family: 'Seymour One', sans-serif;" class="brand-text font-weight-light">AGPA</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <p style="color: white;" class="login-box-msg">X </p>
                        </div>
                        <div>
                            <a style="border-color:white; background-color:#b90606;" type="submit" href="/?c=feria" class="btn btn-primary btn-block">Registrar Ferias</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>