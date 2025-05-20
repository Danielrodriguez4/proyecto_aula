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
            
            <form id="frm-convocatoria" action="?c=Convocatorias&a=Guardar" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" value="<?php echo $alm->nombre; ?>" class="form-control" placeholder="Ingrese Titulo de la Convocatoria" data-validacion-tipo="requerido|min:3" />
                     </div>

                    <div class="form-group">
                            <p><strong>Imagen actual: </strong><?php echo $alm->imagen ?></p>
                        </div>
                        <div class="input-group">

                            <div class="custom-file">
                                <input type="file" name="imagen" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Seleccione la imagen</label>
                            </div>
                        </div>
                    
                    <div class="form-group">
                        <label>Fecha de Apertura de la Convocatoria</label>
                        <input type="date" name="apertura" value="<?php echo $alm->apertura; ?>" class="form-control" placeholder="Ingrese Fecha de Apertura a la convocatoria" data-validacion-tipo="requerido|min:3" />
                    </div>
                        

                </div>
            <div class="card-footer">
                <div class="text-right">
                    <div class="form-group">
                            <button name='estado' value='1' type="submit" class="btn btn-success">Guardar</button>

                    </div>
                    
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