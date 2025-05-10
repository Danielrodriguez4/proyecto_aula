<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Historial de Proyectos</h1>
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
                        <form action="/?c=historial" method="post">
                            <div class="input-group-append">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Archivo</th>
                            <th>Estado</th>
                            <th>Estudiantes</th>
                            <th>Director</th>
                            <th>Jurado1</th>
                            <th>Jurado2</th>
                            <th>Jurado3</th>
                            <th>Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->model->Listar() as $proyecto) : ?>
                            <tr>
                                <td><?php echo $proyecto->titulo; ?></td>
                                <td><?php echo $proyecto->archivo; ?></td>
                                <td><?php
                                    if ($proyecto->estado == 4) {
                                        echo '<span class="badge bg-danger">Finalizado</span>';
                                    }
                                    ?></td>
                                <td><?php echo $proyecto->estudiantes; ?></td>
                                <td><?php echo $proyecto->director; ?></td>
                                <td><?php echo $proyecto->jurado1; ?></td>
                                <td><?php echo $proyecto->jurado2; ?></td>
                                <td><?php echo $proyecto->jurado3; ?></td>
                                <td>
                                    <?php
                                    if ($proyecto->nota >= 1 && $proyecto->nota < 3) {
                                        echo '<span class="badge bg-danger">Malo</span>';
                                    } else if ($proyecto->nota >= 3 && $proyecto->nota < 4) {
                                        echo '<span class="badge bg-warning">Bueno</span>';
                                    } else if ($proyecto->nota >= 4 && $proyecto->nota < 5) {
                                        echo '<span class="badge bg-success">Muy Bueno</span>';
                                    } else if ($proyecto->nota == 5) {
                                        echo '<span class="badge bg-success">Excelente</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <?php
                                        if ($_SESSION['user']->rol == 1) {
                                            echo '<a class="btn btn-danger" onclick="javascript:return confirm(\'¿Seguro de eliminar este registro?\');" href="?c=proyectos&a=Eliminar&id=' . $r->id . '"><i class="fas fa-trash" style="color:white;"></i></a>';
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