<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Proyectos de Aula & Feria de Proyectos</h1>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>

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

<?php
    if (($_SESSION['user']->rol == 1)||($_SESSION['user']->rol == 3)) {
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6"> <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <div class="register-box">
                    <div style="border-color:white; background-color:#b90606;" class="card card-outline card-primary">
                        <div class="card-header text-center">
                            <a style="color: white;" href="/" class="brand-link">
                                <img src="assets\imagen\logo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                                <span style="font-family: 'Seymour One', sans-serif;" class="brand-text font-weight-light">AGPA</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <p style="color: white;" class="login-box-msg">
                               <img src="assets/convocatorias/<?php echo $convocatoria->picture; ?>" alt="Imagen de la convocatoria" style="width: 300px; height: auto; object-fit: cover;">

                        </div>
                         <div>
                            <a style="border-color:white; background-color:#b90606;" type="submit" href="/?c=feria&a=editar&id=" class="btn btn-primary btn-block">Registrar Ferias</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6"> <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <div class="register-box">
                    <div style="border-color:white; background-color:#b90606;" class="card card-outline card-primary">
                        <div class="card-header text-center">
                            <a style="color: white;" href="/" class="brand-link">
                                <img src="assets\imagen\logo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                                <span style="font-family: 'Seymour One', sans-serif;" class="brand-text font-weight-light">AGPA</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <p style="color: white;" class="login-box-msg">
                               <img src="assets/convocatorias/<?php echo $convocatoria->picture; ?>" alt="Imagen de la convocatoria" style="width: 300px; height: auto; object-fit: cover;">

                        </div>
                        <div>
                            <a style="border-color:white; background-color:#b90606;" type="submit" href="/?c=proyectos&a=editar&id=" class="btn btn-primary btn-block">Registrar Proyecto</a>                                               
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}else {
?>
    <?php
    ?>
    <div class="container">
    <div class="row">
        <div class="col-sm-3"> <!-- /.card-header -->
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
                            <p style="color: white;" class="login-box-msg">
                               <img src="assets/convocatorias/<?php echo $convocatoria->picture; ?>" alt="Imagen de la convocatoria" style="width: 300px; height: auto; object-fit: cover;">

                        </div>
                        <div>
                            <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <?php
                        if ($_SESSION['user']->rol == 2  && empty($this->model->Listar($_REQUEST['table_search']))) {
                            echo '<a style="border-color:white; background-color:#b90606;" type="submit" href="/?c=feria&a=editar&id=" class="btn btn-primary btn-block">Registrar Ferias</a>';
                        }
                        ?>
                    </div>
                </div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
}
?>
