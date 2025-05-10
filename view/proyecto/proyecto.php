<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Proyectos</h1>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <form action="/?c=Proyectos" method="post">
                        <div class="input-group-append">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                </div>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <?php
                        if ($_SESSION['user']->rol == 2) {
                            echo '<a href="?c=Proyectos&a=Editar" style="border-color:white; background-color:#b90606;" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>Nuevo proyecto</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Asignatura</th>
                            <th>Titulo</th>
                            <th># Estudiantes</th>
                            <th>Archivos</th>
                            <th>Estado</th>
                            <th>Entregado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->model->Listar($_REQUEST['table_search']) as $r) : ?>
                            <tr>
                                <td><?php echo $r->asignatura; ?></td>
                                <td><?php echo $r->titulo; ?></td>
                                <td><?php echo $r->num_est; ?></td>
                                <td><?php ?>
                                <div class="form-group">
                                        <a style="border-color:white; background-color:#b90606; color:black;" target="_blank" class="btn btn-outline-primary btn-block" href="<?php echo $alm->archivo ?>">Descargar proyecto</a>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    if ($r->estado == 1) {
                                        echo '<span class="badge bg-info">Por revisar</span>';
                                    }
                                    if ($r->estado == 2) {
                                        echo '<span class="badge bg-warning">Revisado</span>';
                                    }
                                    if ($r->estado == 3) {
                                        echo '<span class="badge bg-success">Aprobado</span>';
                                    }
                                    if ($r->estado == 4) {
                                        echo '<span class="badge bg-danger">Finalizado</span>';
                                    }

                                    ?>
                                </td>
                                <td><?php echo $r->fecha_entrega; ?></td>
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="?c=Proyectos&a=Editar&id=<?php echo $r->id; ?>" class="fas fa-eye" style="color:black;"></a>
                                    </div>
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

