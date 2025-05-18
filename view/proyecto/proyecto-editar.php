<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Proyecto</h1>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                    <?php
                        if ($_SESSION['user']->rol == 2) {
                            echo '<a href="?c=usuarios&a=Crud&p='. $alm->id .'"  style="border-color:white; background-color:#b90606;" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>Agregar Estudiante</a>';
                        }
                        ?>   
                    </div>
                </div>
            </div>
            <form id="frm-proyecto" action="?c=Proyectos&a=Guardar" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />

                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" name="title" value="<?php echo $alm->titulo; ?>" class="form-control" placeholder="Ingrese Titulo del proyecto" data-validacion-tipo="requerido|min:3" />
                    </div>

                    <div class="form-group">
                        <label>Numero Estudiantes</label>
                        <input type="number" name="num_est" value="<?php echo $alm->num_est; ?>" class="form-control" placeholder="Ingrese la Numero de Estudiantes del Proyecto" data-validacion-tipo="requerido|min:10" />
                    </div>
                    <?php
                    if ($_SESSION['user']->rol == 2) {
                    ?><div class="form-group">
                            <a style="border-color:white; background-color:#b90606; color:black;" target="_blank" class="btn btn-outline-primary btn-block" href="<?php echo $alm->archivo ?>">Descargar proyecto</a>
                        </div>
                    <?php
                    } else {
                    ?><div class="form-group">
                            <p><strong>Archivo actual: </strong><?php echo $alm->archivo ?></p>
                        </div>
                        <div class="input-group">

                            <div class="custom-file">
                                <input type="file" name="archivo" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Seleccione el archivo</label>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    ?>
                        <div class="form-group">
                            <label>Docente</label>
                            <select name="jurado" class="custom-select">
                                <option value="">Seleccione Docente</option>
                                <?php foreach ($docentes->Listar() as $docente) : ?>
                                    <option <?php echo $alm->jurado == $docente->id ? 'selected' : ''; ?> value="<?php echo $docente->id; ?>"><?php echo $docente->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    
                    <?php
                    ?>
                        <div class="form-group">
                            <label>Asignatura</label>
                            <select name="jurado" class="custom-select">
                                <option value="">Seleccione Docente</option>
                                <?php foreach ($docentes->Listar() as $docente) : ?>
                                    <option <?php echo $alm->jurado == $docente->id ? 'selected' : ''; ?> value="<?php echo $docente->id; ?>"><?php echo $docente->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                </div>
            <div class="card-footer">
                <div class="text-right">
                    <?php
                    if ($_SESSION['user']->rol == 1) {
                    ?> <div class="form-group">
                            <button name='estado' value='2' type="submit" class="btn btn-warning">Revisado</button>

                            <button name='estado' value='3' type="submit" class="btn btn-success">Aprobado</button>

                            <button name='estado' value='4' type="submit" class="btn btn-danger">Finalizado</button>

                        </div>
                    <?php
                    } else {
                    ?><div class="form-group">
                            <button name='estado' value='1' type="submit" class="btn btn-success">Guardar</button>

                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

            <script>
            $(function () {
                $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                });
            });
            </script>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>