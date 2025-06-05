<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Feria de Proyecto de Aula</h1>
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

            <form id="frm-feria" action="?c=feria&a=Guardar" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />

                    <div class="form-group">
                        <label>Nombre de la Asignatura - Grupo </label>
                        <input type="text" name="nom_cur" value="<?php echo $alm->nom_cur; ?>" class="form-control" placeholder="Ingrese Nombre de la Asignatura - Grupo " data-validacion-tipo="requerido|min:3" />
                    </div>
                    <?php
                    if ($_SESSION['user']->rol == 2) {
                    ?>
                        <div class="form-group">
                            <label>Nombre del docente orientador</label>
                            <select name="doc_ori" class="custom-select">
                                <option value="">Seleccione Docente</option>
                                <?php foreach ($docentes->Listar() as $docente) : ?>
                                    <option <?php echo $alm->doc_ori == $docente->id ? 'selected' : ''; ?> value="<?php echo $docente->id; ?>"><?php echo $docente->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php
                    } else {
                    ?>
                            <div class="form-group">
                                <label>Nombre del docente orientador</label>
                                <select name="doc_ori" class="custom-select">
                                    <?php $d1 = $docentes->Obtener($alm->doc_ori); ?>
                                    <option value="<?php echo $d1->id; ?>" selected><?php echo $d1->nombre; ?></option>
                                </select>
                            </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label>Proyecto está proyectado  para ejecutarlo en:</label>
                        <input type="text" name="tiem_eje" value="<?php echo $alm->tiem_eje; ?>" class="form-control" placeholder="Ingrese numero de meses que el proyecto está proyectado  para ejecutarlo" data-validacion-tipo="requerido|min:3" />
                    </div>
                    <div class="form-group">
                        <label>Fecha de entrega: <?php echo $alm->fecha_entrega; ?></label>
                        <input type="date" name="fecha_entrega" value="<?php echo htmlspecialchars($alm->fecha_entrega); ?>" class="form-control" />
                    </div>
                     <div class="form-group">
                        <label>Fecha de finalizacion <?php echo $alm->fecha_fin; ?></label>
                        <input type="date" name="fecha_fin" value="<?php echo htmlspecialchars($alm->fecha_fin); ?>" class="form-control" />
                    </div>
                   
                   <div class="form-group">
                        <label>Estado del proyecto</label>
                        <select name="est_por" class="form-control">
                            <option value="">Seleccione el estado de su proyecto</option>
                            <option value="1" <?php echo $alm->est_por == 1 ? 'selected' : ''; ?>>Entre 25%</option>
                            <option value="2" <?php echo $alm->est_por == 2 ? 'selected' : ''; ?>>Entre 50%</option>
                            <option value="3" <?php echo $alm->est_por == 3 ? 'selected' : ''; ?>>Entre 75%</option>
                            <option value="4" <?php echo $alm->est_por == 4 ? 'selected' : ''; ?>>100%</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipo de proyecto</label>
                        <select name="tip_pro" class="form-control">
                            <option value="">Opción a Seleccionar</option>
                            <option value="2" <?php echo $alm->tip_pro == 2 ? 'selected' : ''; ?>>Emprendimiento</option>
                            <option value="3" <?php echo $alm->tip_pro == 3 ? 'selected' : ''; ?>>Innovación</option>
                            <option value="4" <?php echo $alm->tip_pro == 4 ? 'selected' : ''; ?>>Aprendizaje de Aula</option>
                            <option value="5" <?php echo $alm->tip_pro == 5 ? 'selected' : ''; ?>>Integrador</option>
                        </select>
                    </div>
                    
                    <?php
                    if ($_SESSION['user']->rol == 1) {
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
                    if ($_SESSION['user']->rol == 1) {
                    ?> <div class="form-group">
                            <label>Comentario</label>
                            <input type="text" name="comentario" value="<?php echo $alm->comentario; ?>" class="form-control" placeholder="Agregue Comentarios" data-validacion-tipo="requerido|min:10" />
                        </div>
                    <?php
                    } else {
                    ?><div class="form-group">
                            <p><strong>Observaciones: </strong><?php echo $alm->comentario ?></p>
                            <input readonly type="text" name="comentario" value="<?php echo $alm->comentario; ?>" class="form-control" placeholder="Agregue Comentarios" data-validacion-tipo="requerido|min:10" />
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if ($_SESSION['user']->rol == 1) {
                    ?>
                        <div class="form-group">
                            <label>Jurado</label>
                            <select name="jurado" class="custom-select">
                                    <option value="">Seleccione Jurado</option>
                                    <?php foreach ($docentes->Listar() as $docente) : ?>
                                        <?php if ($docente->id != $alm->doc_ori) : ?>
                                            <option <?php echo $alm->jurado == $docente->id ? 'selected' : ''; ?> value="<?php echo $docente->id; ?>">
                                                <?php echo $docente->nombre; ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Nota</label>
                            <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control" placeholder="Agregue Nota" data-validacion-tipo="requerido|min:10" />
                        </div>
                    <?php
                    } else if ($_SESSION['user']->rol == 2) {
                    ?>
                            <div class="form-group">
                                <label>Jurado</label>
                                <select name="jurado" class="custom-select">
                                    <?php $j1 = $docentes->Obtener($alm->jurado); ?>
                                    <option value="<?php echo $j1->id; ?>" selected><?php echo $j1->nombre; ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nota</label>
                                <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control" placeholder="Agregue Nota" data-validacion-tipo="requerido|min:10" disabled />
                            </div>
                    <?php
                    }
                    ?>
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
    $(function() {
        bsCustomFileInput.init();
    });
</script>