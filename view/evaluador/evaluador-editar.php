<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Evaluadores</h1>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $alm->id != null ? $alm->nombre : 'Registro de un Nuevo Evaluador'; ?></h3>
            </div>
            <form id="frm-docente" action="?c=evaluadores&a=Guardar" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />

                    <div class="form-group">
                        <label>Codigo</label>
                        <input type="text" name="codigo" value="<?php echo $alm->codigo; ?>" class="form-control" placeholder="Ingrese Codigo" data-validacion-tipo="requerido|min:3" />
                    </div>

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" value="<?php echo $alm->nombre; ?>" class="form-control" placeholder="Ingrese Nombre" data-validacion-tipo="requerido|min:3" />
                    </div>

                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido" value="<?php echo $alm->apellido; ?>" class="form-control" placeholder="Ingrese apellido" data-validacion-tipo="requerido|min:10" />
                    </div>

                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" name="correo" value="<?php echo $alm->correo; ?>" class="form-control" placeholder="Ingrese correo" data-validacion-tipo="requerido|min:10" />
                    </div>

                    <div class="form-group">
                        <label>Cargo</label>
                        <select name="cargo" class="form-control">
                            <option value="1" selected>Director</option>
                            <option value="2">Jurado</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Guardar</button>
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