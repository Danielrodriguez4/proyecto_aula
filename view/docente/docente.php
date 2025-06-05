<?php
if ($_SESSION['user']->rol == 2) {
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Docentes</h1>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <form action="/?c=Docentes" method="post"> 
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
                        if ($_SESSION['user']->rol == 1) {
                            echo '<a href="?c=Docentes&a=Editar" style="border-color:white; background-color:#b90606;" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>Nuevo Docente</a>';
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
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Cargo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->model->Listar() as $r) : ?>
                            <tr>
                                <td><?php echo $r->codigo; ?></td>
                                <td><?php echo $r->nombre; ?></td>
                                <td><?php echo $r->apellido; ?></td>
                                <td><?php echo $r->correo; ?></td>
                                <td>
                                    <?php
                                        if($r->cargo == 1){
                                            echo '<span class="badge bg-danger">Jurado</span>';
                                        } 
                                    ?>
                                </td>
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                    <a href="?c=Docentes&a=Editar&id=<?php echo $r->id; ?>" class="fas fa-eye" style="color:black;"></a>
                                    </div>
                                </td>
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <?php
                                        if($_SESSION['user']->rol==1){
                                            echo '<a class="btn btn-danger" onclick="javascript:return confirm(\'¿Seguro de eliminar este docente?\');" href="?c=docentes&a=Eliminar&id='.$r->id.'"><i class="fas fa-trash" style="color:white;"></i></a>';
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
    <form method="post" enctype="multipart/form-data" action="?c=docentes&a=CargaMasiva">
        <div class="form-group">
            <h5><strong>Cargar Asignaturas: </strong></h5>
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
                <h1>Docentes</h1>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <form action="/?c=Docentes" method="post"> 
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
                        if ($_SESSION['user']->rol == 1) {
                            echo '<a href="?c=Docentes&a=Editar" style="border-color:white; background-color:#b90606;" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>Nuevo Docente</a>';
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
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Cargo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->model->Listar() as $r) : ?>
                            <tr>
                                <td><?php echo $r->codigo; ?></td>
                                <td><?php echo $r->nombre; ?></td>
                                <td><?php echo $r->apellido; ?></td>
                                <td><?php echo $r->correo; ?></td>
                                <td>
                                    <?php
                                        if($r->cargo == 1){
                                            echo '<span class="badge bg-danger">Jurado</span>';
                                        } 
                                    ?>
                                </td>
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                    <a href="?c=Docentes&a=Editar&id=<?php echo $r->id; ?>" class="fas fa-eye" style="color:black;"></a>
                                    </div>
                                </td>
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <?php
                                        if($_SESSION['user']->rol==1){
                                            echo '<a class="btn btn-danger" onclick="javascript:return confirm(\'¿Seguro de eliminar este docente?\');" href="?c=docentes&a=Eliminar&id='.$r->id.'"><i class="fas fa-trash" style="color:white;"></i></a>';
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