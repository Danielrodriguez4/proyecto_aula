<section  class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Evaluar Feria de Proyectos</h1>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formato de Evaluacion</h3>
            </div>
              <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Contenido</th>
                      <th>Valoración</th>
                      <th>Puntaje</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>
                        <div class="form-group">
                        <label>Resumen (Max-300 Palabras) </label>
                        <p type="text" >contener la información necesaria para darle al lector una idea precisa de la pertinencia y calidad proyecto, éste debe contener una síntesis del problema a investigar, el marco teórico, objetivos, la metodología a utilizar y resultados esperados</p>
                        </div>
                      </td>
                      <td>10%</td>
                      <td><div class="form-group">
                            <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control"  data-validacion-tipo="requerido|max:10" />
                        </div></td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>
                        <div class="form-group">
                        <label>TÍTULO DEL PROYECTO (máximo 40 palabras) </label>
                        <p type="text">Es coherente y corresponde a lo planteado</p>
                        </div>
                      </td>
                      <td>10%</td>
                      <td><div class="form-group">
                            <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control"  data-validacion-tipo="requerido|max:10" />
                        </div></td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>
                        <div class="form-group">
                        <label>OBJETIVO GENERAL (1 objetivo)</label>
                        <p type="text">Es coherente con el problema planteado, y los objetivos específicos necesarios para lograr el objetivo general.</p>
                        </div>
                      </td>
                      <td>10%</td>
                      <td><div class="form-group">
                            <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control"  data-validacion-tipo="requerido|max:10" />
                        </div></td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>
                        <div class="form-group">
                        <label>OBJETIVOS ESPECÍFICOS (máximo 3 objetivos)</label>
                        <p type="text">Con el logro de los objetivos se espera, entre otras, encontrar respuestas a una o más de las siguientes preguntas: ¿Cuál será el conocimiento generado si el trabajo se realiza? ¿Qué solución tecnológica se espera desarrollar?</p>
                        </div>
                      </td>
                      <td>10%</td>
                      <td><div class="form-group">
                            <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control"  data-validacion-tipo="requerido|max:10" />
                        </div></td>
                    </tr>
                    <tr>
                      <td>5.</td>
                      <td>
                        <div class="form-group">
                        <label>ALCANCE DEL PROYECTO Y LIMITACIONES (500 palabras)</label>
                        <p type="text">Están claramente definidos los entregables del proyecto, y especificados aquellos productos que se podrían generar pero que no se abarcaran en el desarrollo del mismo.</p>
                        </div>
                      </td>
                      <td>10%</td>
                      <td><div class="form-group">
                            <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control"  data-validacion-tipo="requerido|max:10" />
                        </div></td>
                    </tr>
                    <tr>
                      <td>6.</td>
                      <td>
                        <div class="form-group">
                        <label>ESTADO DEL ARTE (500 palabras)</label>
                        <p type="text">Se fundamenta dentro de la diversidad de autores de teorías, enfoques y corrientes que sirven de base para la formulación del problema. Explica la relación de los antecedentes con el objeto de estudio.</p>
                        </div>
                      </td>
                      <td>10%</td>
                      <td><div class="form-group">
                            <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control"  data-validacion-tipo="requerido|max:10" />
                        </div></td>
                    </tr>
                    <tr>
                      <td>7.</td>
                      <td>
                        <div class="form-group">
                        <label>RESULTADOS ESPERADOS y/o OBTENIDOS</label>
                        <p type="text">Se describen de manera clara de acuerdo con los objetivos planteados.</p>
                        </div>
                      </td>
                      <td>10%</td>
                      <td><div class="form-group">
                            <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control"  data-validacion-tipo="requerido|max:10" />
                        </div></td>
                    </tr>
                    <tr>
                      <td>8.</td>
                      <td>
                        <div class="form-group">
                        <label>Presupuesto del PROYECTO</label>
                        <p type="text">Define las actividades, etapas, tiempos y costos previstos para el desarrollo del proyecto y estos son consistentes con el mismo.</p>
                        </div>
                      </td>
                      <td>5%</td>
                      <td><div class="form-group">
                            <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control"  data-validacion-tipo="requerido|max:10" />
                        </div></td>
                    </tr>
                    <tr>
                      <td>9.</td>
                      <td>
                        <div class="form-group">
                        <label>REFERENCIAS BIBLIOGRÁFICAS ( Norma APA)</label>
                        <p type="text">Se registran de acuerdo con la norma establecida por la UFPS para referencias.</p>
                        </div>
                      </td>
                      <td>10%</td>
                      <td><div class="form-group">
                            <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control"  data-validacion-tipo="requerido|max:10" />
                        </div></td>
                    </tr>
                    <tr>
                      <td>10.</td>
                      <td>
                        <div class="form-group">
                        <label>PRESENTACION DEL PROYECTO DE AULA - SEMILLERO</label>
                        <p type="text">Cumplimiento del Formato de presentación, redacción y ortografía.</p>
                        </div>
                      </td>
                      <td>15%</td>
                      <td><div class="form-group">
                            <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control"  data-validacion-tipo="requerido|max:10" />
                        </div></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <label>Nota</label>
                        </td>
                        <td></td>
                        <td>
                            
                            <div class="form-group">
                                <input type="number" name="nota" value="<?php echo $alm->nota; ?>" class="form-control" data-validacion-tipo="requerido|min:10" />
                            </div>
                        </td>
                    </tr>
                    <?php
                    if($_SESSION['user']->rol == 3) {
                    ?><div class="form-group">
                            <p><strong>Observaciones: </strong><?php echo $alm->comentario ?></p>
                            <input readonly type="text" name="comentario" value="<?php echo $alm->comentario; ?>" class="form-control" placeholder="Agregue Comentarios" data-validacion-tipo="requerido|min:10" />
                        </div>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
                    <div class="card-footer">
                        <div class="text-right">
                            <button name='estado' value='1' type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

