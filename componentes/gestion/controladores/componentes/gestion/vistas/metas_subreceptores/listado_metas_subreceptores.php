<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-stats themed-color"></i> Metas Subreceptores<br>
        <small>Listado de Metas de Subreceptores registrados en el sistema.</small>
    </h1>
</div>
<!-- END Pre Page Content -->


<!-- Page Content -->
<div id="page-content">
    <!-- Breadcrumb -->
    <!-- You can have the breadcrumb stick on scrolling just by adding the following attributes with their values (data-spy="affix" data-offset-top="250") -->
    <!-- You can try it on other elements too :-), the sticky position and style can be adjusted in the css/main.css with .affix class -->
    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Gestion</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Metas Subreceptores</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <a href="javascript:abrir_form_nueva_meta_subreceptor();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span><br>
            <select id="subreceptor" name="subreceptor" class="select-chosen " style="" >
                <option value >seleccione un subreceptor</option>
                <?php
                foreach ($subreceptores as $subreceptor) {
                    $selected = "";
                    if (isset($datosSubreceptores))
                        if ($subreceptor->ID_SUBRECEPTOR == $datosSubreceptores->ID_SUBRECEPTOR)
                            $selected = " selected ";
                    ?>
                    <option value="<?php echo $subreceptor->ID_SUBRECEPTOR ?>"   <?php echo $selected; ?> ><?php echo ($subreceptor->SIGLAS_SUBRECEPTOR) ?></option>
                <?php } ?>
            </select>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:abrir_form_nuevas_metas_subreceptor();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-success"><i class="icon-pencil"></i> Actualizar Metas </a>
            <a href="javascript:mostrar_formulario_editar_meta_subreceptor()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:eliminar_meta_subreceptor()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
   </div>

  <!--   <table class="botones_arriba" align="center" ><tr><td> 
                <div  class=" span3 btn-group" >                
                    <select id="subreceptor" name="subreceptor" class="select-chosen " style="" >
                        <option value >seleccione un subreceptor</option>
                     
                    </select>
                </div>
                <div class=" span3 btn-group">         
                    <a href="javascript:abrir_form_nuevas_metas_subreceptor();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-success"><i class="icon-pencil"></i> Actualizar Metas </a>						                
                    <a href="javascript:mostrar_formulario_editar_meta_subreceptor();" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-success"><i class="icon-pencil"></i></a>
                    <a href="javascript:abrir_form_nueva_meta_subreceptor();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo </a>						
                    <a href="javascript:eliminar_meta_subreceptor();" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i></a>
                </div>
            </td></tr></table>-->


    <!-- Dynamic Tables Section -->
    <div class="block-section">


        <table id="tblMetaSubreceptor" class="table table-striped dataTables" >
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Siglas</th>
                    <th>Nombre</th>
                    <th>Periodo</th>
                    <th>Indicador</th>
                    <th>Meta</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($metaSubreceptores as $metaSubreceptor) : ?>  
                    <tr fila-id="<?php echo ($metaSubreceptor->ID_SUBRECEPTOR_META) ?>"  data-nombre="<?php echo ($metaSubreceptor->SIGLAS_SUBRECEPTOR).': '.($metaSubreceptor->NOMBRE_INDICADOR) ?>">                
                        <td><?php echo ($metaSubreceptor->CODIGO_SUBRECEPTOR) ?></td>
                        <td><?php echo ($metaSubreceptor->SIGLAS_SUBRECEPTOR) ?></td>
                        <td><?php echo ($metaSubreceptor->NOMBRE_SUBRECEPTOR) ?></td> 
                        <td><?php echo ($metaSubreceptor->TITULO_PERIODO_INDICADOR) ?></td>
                        <td><?php echo ($metaSubreceptor->NOMBRE_INDICADOR) ?></td>
                        <td><?php echo ($metaSubreceptor->META_SUBRECEPTOR) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>



    </div>
    <!-- END Dynamic Tables Section -->



</div>



<script>
    $(document).ready(function() {
        $('#tblMetaSubreceptor tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
            mostrar_formulario_editar_meta_subreceptor();
        });

        $('#tblMetaSubreceptor tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
    });

    function eliminar_meta_subreceptor() {
        var tabla = $('#tblMetaSubreceptor').dataTable();
        var idFila = filaId(tabla);

        if (idFila != null) {
            ejecutarAccionJson(
                    'gestion', 'metasSubreceptores', 'eliminar_meta_subreceptor', 'id_meta_subreceptor=' + idFila,
                    ' mostrar_resultado_guardar( data, "abrir_lista_metas_subreceptores();", "" );'
                    );
        } else {
            alert('Seleccione un registro');
        }
    }
    function mostrar_formulario_editar_meta_subreceptor() {
        var tabla = $('#tblMetaSubreceptor').dataTable();
        var idFila = filaId(tabla);

        if (idFila != null) {
            mostrar_contenidos(
                    'gestion', 'metasSubreceptores', 'editar_form_meta_subreceptor', 'id_meta_subreceptor=' + idFila
                    );
        } else {
            alert('seleccione un registro');
        }
    }


    function abrir_form_nuevas_metas_subreceptor() {
        var idFila = $('#subreceptor').val();
        if (idFila != '') {
            agregar_nuevas_metas_por_subreceptor(idFila);
        } else {
            alert('Seleccione un subreceptor');
        }
    }
</script>
