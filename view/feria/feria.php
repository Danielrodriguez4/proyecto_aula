<section  class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Feria de Proyectos de Aula</h1>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> 
                <div class="input-group input-group-sm" style="width: 150px;">
                    <form action="/?c=feria" method="post">
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
                            echo '<a href="?c=feria&a=editar" style="border-color:white; background-color:#b90606;" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>Registrar proyecto</a>';
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
                            <th>Nombre Asigantura</th>
                            <th>Docente Orientador</th>
                            <th>Archivo</th>
                            <th>Observación</th>
                            <th>Entregado</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->model->Listar($_REQUEST['table_search']) as $r) : ?>
                            <tr>
                                <td><?php echo $r->nom_cur; ?></td>
                                <td><?php echo $r->doc_ori; ?></td>
                                <td><?php echo $r->archivo; ?></td>
                                <td><?php echo $r->comentario; ?></td>
                                <td><?php echo $r->fecha_entrega; ?></td>
                                <td><?php echo $r->estado; ?></td>
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
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="?c=feria&a=editar&id=<?php echo $r->id; ?>" class="fas fa-eye" style="color:black;"></a>
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