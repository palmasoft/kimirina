
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-user themed-color"></i>Gestores de subreceptores<br>
        <small>Listado de subreceptores para cada Gestor.</small>
    </h1>
</div>
<!-- END Pre Page Content -->

<!-- Page Content -->
<div id="page-content">
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Gestion</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="">Gestores de subreceptores</a></li>
    </ul>
    <!-- END Breadcrumb -->    

    <table class="botones_arriba" align="center" ><tr><td>
                <div class=" span1 btn-group">
                    <a href="javascript:abrir_formulario_gestores_subreceptor();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
                </div>
                <span class="span3 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
                <div class="btn-group"><a href="javascript:mostrar_formulario_editar_gestor_subreceptores();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-success"><i class="icon-pencil"></i></a>
                    <a href="javascript:eliminar_gestor_subreceptores();" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i></a>
                </div>
            </td></tr></table>


    <!-- Dynamic Tables Section -->
    <div class="block-section">       


        <table id="tbl-gestores-subreceptores" class="table table-striped dataTables">
            <thead>

                <tr>
                    <th>Gestor</th>
                    <th>Subreceptor</th>
                </tr>
            </thead>
            <tbody> 
                <?php if (!empty($datosGestoresSubreceptores)) {?>
                <?php foreach($datosGestoresSubreceptores as $datos): ?>
                <tr fila-id="<?php echo ($datos->ID_SUBRECEPTOR_GESTOR) ?>"  data-nombre="<?php echo ($datos->SIGLAS_SUBRECEPTOR). " - ". $datos->NOMBRE_REAL_PERSONA ?>">   
                    <td> <?php echo $datos->NOMBRE_REAL_PERSONA ?></td>
                    <td> <?php echo $datos->SIGLAS_SUBRECEPTOR ?></td>
                </tr>
                <?php endforeach;
                    }
                ?>
            </tbody>
        </table>




    </div>


</div>



<script>
    $(document).ready(function() {
        $('#tbl-gestores-subreceptores tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
    });
    $('#tbl-gestores-subreceptores tbody tr').live('click', function(e) {
        $('#registro-seleccionado').html($(this).attr('data-nombre'));
    });


    function mostrar_formulario_editar_gestor_subreceptores() {
        var tabla = $('#tbl-gestores-subreceptores').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'gestion', 'gestoresSubreceptores', 'editar_form_gestor_subreceptores', 'id_gestor_subreceptor=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }

    }
    function eliminar_gestor_subreceptores() {
        var tabla = $('#tbl-gestores-subreceptores').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            ejecutarAccionJson(
                    'gestion', 'gestoresSubreceptores', 'eliminar_gestor_subreceptores', 'id_gestor_subreceptor=' + idFila,
                    'mostrar_resultado_guardar( data, "abrir_listado_gestores_subreceptores();", "" );'
                    );
        } else {
            alert('Seleccione un registro');
        }

    }
</script>