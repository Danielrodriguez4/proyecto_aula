<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Equipo de trabajo</h1>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $alm->id != null ? $alm->nombre : 'Registro de Nuevo Usuario'; ?></h3>
            </div>
            <form id="frm-estudiante" action="?c=usuarios&a=Guardar" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />
                    <input type="hidden" name="p" value="<?php echo $_GET['p']; ?>" />

                                       
                     <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" value="<?php echo $alm->nombre; ?>" class="form-control" placeholder="Ingrese Nombre" data-validacion-tipo="requerido|min:3" />
                    </div>

                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido" value="<?php echo $alm->apellido; ?>" class="form-control" placeholder="Ingrese apellido" data-validacion-tipo="requerido|min:10" />
                    </div>
                    
                    <div class="form-group">
                        <label>Numero Identificación</label>
                        <input type="number" name="num_id" value="<?php echo $alm->num_id; ?>" class="form-control" placeholder="Ingrese Numero de Identificación" data-validacion-tipo="requerido|min:3" />
                    </div>

                    <div class="form-group">
                        <label>Codigo</label>
                        <input type="number" name="codigo" value="<?php echo $alm->codigo; ?>" class="form-control" placeholder="Ingrese Codigo" data-validacion-tipo="requerido|min:3" />
                    </div>

                    <div class="form-group">
                        <label>Semestre</label>
                        <input type="number" name="semestre" value="<?php echo $alm->semestre; ?>" class="form-control" placeholder="Ingrese semestre" data-validacion-tipo="requerido|min:3" />
                    </div>


                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" name="telefono" value="<?php echo $alm->telefono; ?>" class="form-control" placeholder="Ingrese telefono" data-validacion-tipo="requerido|min:10" />
                    </div>

                    <div class="form-group">
                        <label>Sexo</label>
                            <select name="sexo" class="form-control">
                             <option value="m" selected>Masculino</option>
                             <option value="f">Femenino</option>
                             </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="correo" value="<?php echo $alm->correo; ?>"class="form-control" placeholder="Correo">
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