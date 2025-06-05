<?php
if ($_SESSION['user']->rol == 2) {
?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Equipo de trabajo.</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Identificación</th>
                                <th>Codigo</th>
                                <th>Semestre</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Sexo</th>
                                <th>Cargo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->model->Listar() as $r) : ?>
                                <tr>
                                    <td><?php echo $r->nombre; ?></td>
                                    <td><?php echo $r->apellido; ?></td>
                                    <td><?php echo $r->num_id; ?></td>
                                    <td><?php echo $r->codigo; ?></td>
                                    <td><?php echo $r->semestre; ?></td>
                                    <td><?php echo $r->correo; ?></td>
                                    <td><?php echo $r->telefono; ?></td>
                                    <td><?php echo $r->sexo; ?></td>
                                    <td><?php echo $r->cargo; ?></td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <?php
                                            if ($_SESSION['user']->rol == 2) {
                                                echo '<a class="btn btn-danger" onclick="javascript:return confirm(\'¿Seguro de eliminar este registro?\');" href="?c=usuarios&a=Eliminar&id=' . $r->id . '"><i class="fas fa-trash" style="color:white;"></i></a>';
                                            }

                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <?php
    ?>
    <br>
    <form method="post" enctype="multipart/form-data" action="?c=usuarios&a=CargaMasiva">
        <div class="form-group">
            <h5><strong>Cargar Estudientes: </strong></h5>
        </div>
        <div class="input-group">

            <div class="custom-file">
                <input type="file" name="archivo" class="custom-file-input" require id="exampleInputFile" accept=".csv" required>
                <label class="custom-file-label" for="exampleInputFile">Seleccione el archivo</label>
            </div>
        </div>
        <button type="submit" class="btn btn-success m-2">
            Enviar
        </button>
        <script>
            $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $('.custom-file-label').html(fileName);
            });
        </script>
    </form>
    <?php

    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Equipo de trabajo.</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Identificación</th>
                                <th>Codigo</th>
                                <th>Semestre</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Sexo</th>
                                <th>Cargo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->model->Listar() as $r) : ?>
                                <tr>
                                    <td><?php echo $r->nombre; ?></td>
                                    <td><?php echo $r->apellido; ?></td>
                                    <td><?php echo $r->num_id; ?></td>
                                    <td><?php echo $r->codigo; ?></td>
                                    <td><?php echo $r->semestre; ?></td>
                                    <td><?php echo $r->correo; ?></td>
                                    <td><?php echo $r->telefono; ?></td>
                                    <td><?php echo $r->sexo; ?></td>
                                    <td><?php echo $r->cargo; ?></td>
                                    
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <?php
                                            if ($_SESSION['user']->rol == 1||$rol ==2) {
                                                echo '<a class="btn btn-danger" onclick="javascript:return confirm(\'¿Seguro de eliminar este registro?\');" href="?c=usuarios&a=Eliminar&id=' . $r->id . '"><i class="fas fa-trash" style="color:white;"></i></a>';
                                            }

                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php

}
?>

