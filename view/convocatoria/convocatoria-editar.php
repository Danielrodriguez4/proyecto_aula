<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Convocatoria</h1>
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
                        if ($_SESSION['user']->rol == 1) {
                            echo '<a href="?c=usuarios&a=Crud&p='. $alm->id .'"  style="border-color:white; background-color:#b90606;" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>Agregar Estudiante</a>';
                        }
                        ?>   
                    </div>
                </div>
            </div>
            <form action="?c=Convocatorias&a=Guardar" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />
        <input type="hidden" name="imagen" value="<?php echo $alm->imagen; ?>" />

         <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo $alm->nombre ?? ''; ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>Imagen (Picture)</label>
            <input type="file" name="picture" class="form-control">
            <?php if (!empty($alm->picture)): ?>
                <img src="assets/convocatorias/<?php echo $alm->picture; ?>" width="150">
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Fecha de Apertura</label>
            <input type="date" name="apertura" value="<?php echo $alm->apertura ?? ''; ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>Fecha de Cierre</label>
            <input type="date" name="cierre" value="<?php echo $alm->cierre ?? ''; ?>" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>

<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>