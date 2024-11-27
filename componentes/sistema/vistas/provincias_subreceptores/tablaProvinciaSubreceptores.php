
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="fa-sitemap themed-color"></i> Listado Subreceptores en Provincias<br>
        <small>Subreceptores en Provincias</small>
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
            <a href="#">Configuración</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Relaciones Subreceptores - Provincias</a></li>
    </ul>
    <!-- END Breadcrumb -->

    <div class="row-fluid">
        <div class="span3 text-right " >SubReceptor: </div>
        <div class="span5 text-center">
            <div class="controls" >
                <select id="subreceptor-provincias" name="subreceptor-provincias" class="select-chosen span12"   >                                        
                    <?php
                    foreach ($SubReceptores as $subreceptor) {
                        $selected = "";
                        if (isset($SubReceptor)) {
                            if ($subreceptor->ID_SUBRECEPTOR == $SubReceptor->ID_SUBRECEPTOR) {
                                $selected = " selected ";
                            }
                        }
                        ?>
                        <option value="<?php echo $subreceptor->ID_SUBRECEPTOR ?>"   data-siglas="<?php echo $subreceptor->SIGLAS_SUBRECEPTOR ?>"   <?php echo $selected; ?> ><?php echo ($subreceptor->SIGLAS_SUBRECEPTOR) ?> - <?php echo ($subreceptor->NOMBRE_SUBRECEPTOR) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="span4 text-left">
            <a href="javascript:abrir_cambiar_provincias_subreceptor();" data-toggle="tooltip" title="Cambiar relaciones del Subreceptor y sus Provincias" class="btn btn-lg btn-info"><i class="icon-plus"></i> Provincias Asociadas</a>
        </div>
    </div>

    <div class=" row-fluid botones_arriba" >
        <div class=" span2 btn-group text-left">	            
            <a style="display:none;"  href="javascript:abrir_formulario_subreceptor_provincia();" data-toggle="tooltip" title="Agregar nueva relacion Subreceptor - Provincia" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nueva</a>
        </div>
        <div class="span6 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
        <!--    <a href="javascript:editar_subreceptor_provincia()" data-toggle="tooltip" title="Editar relacion Subreceptor - Provincia" class="btn btn-lg btn-warning"><i class="icon-pencil"></i> Editar</a>-->
          <!--  <a href="javascript:confirmar_eliminar_subreceptor_provincia()" data-toggle="tooltip" title="Borrar relacion Subreceptor - Provincia" class="btn btn-lg btn-danger"><i class="icon-remove"></i> Eliminar</a>-->
        </div>
    </div>


    <!-- With Stripes Section -->
    <div class="block-section">

        <table id="subreceptor-provincia-tabla" class="table table-bordered table-hover dataTables">
            <thead>
                <tr>                            
                    <th class="text-center">SIGLAS</th>
                    <th class="text-center">NOMBRE</th>
                    <th class="text-center">PROVINCIA</th>                            
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($SubreceptorProvincia as $subprovincia) {
                    echo '
                                <tr fila-id="' . $subprovincia->ID_PROVINCIA_SUBRECEPTOR . '" data-titulo="' . ($subprovincia->NOMBRE_SUBRECEPTOR) . '-' . ($subprovincia->NOMBRE_PROVINCIA) . '">
                                    <td>' . ($subprovincia->SIGLAS_SUBRECEPTOR) . '</td>
                                    <td>' . ($subprovincia->NOMBRE_SUBRECEPTOR) . '</td>
                                    <td>' . ($subprovincia->NOMBRE_PROVINCIA) . '</td>                            
                                </tr>
                            ';
                }
                ?>
            </tbody>
        </table>

    </div>
</div>                   

<script>
    $(document).ready(function() {
        $('#subreceptor-provincia-tabla tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');

            var tabla = $('#subreceptor-provincia-tabla').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
            editar_subreceptor_provincia();
        });

        $('#subreceptor-provincia-tabla tbody tr').live('click', function(e) {
            var tabla = $('#subreceptor-provincia-tabla').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
        });
    });


    function abrir_cambiar_provincias_subreceptor() {
        var idFila = $('#subreceptor-provincias').val();
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'sistema', 'subreceptoresProvincias', 'mostrar_cambiar_provincias_subreceptor', 'subreceptor_id=' + idFila
                    );
        } else {
            alert('Debes seleccionar un subreceptor.')
        }

    }



    function editar_subreceptor_provincia() {
        var tabla = $('#subreceptor-provincia-tabla').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'sistema', 'subreceptoresProvincias', 'editar_form_subreceptores_provincias', 'registro_id=' + idFila
                    );
        } else {
            alert('Debes seleccionar un registro.')
        }

    }

    function confirmar_eliminar_subreceptor_provincia() {
        var tabla = $('#subreceptor-provincia-tabla').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            var tabla = $('#subreceptor-provincia-tabla').dataTable();
            var nameTipo = filaSeleccionada(tabla, 'data-titulo');
            confirm('¿Seguro que desea eliminar las relacion <strong>' + nameTipo + '</strong>?', 'eliminar_subreceptor_provincia();');
        } else {
            alert('Debes seleccionar un registro.')
        }
    }

    function eliminar_subreceptor_provincia() {
        var tabla = $('#subreceptor-provincia-tabla').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            ejecutarAccionJson(
                    'sistema', 'subreceptoresProvincias', 'eliminar_subreceptores_provincias', 'id_subreceptor=' + idFila,
                    ' mostrar_resultado_guardar( data, "tabla_subreceptor_provincia();", "" );'
                    );
        } else {
            alert('Debes seleccionar un registro.')
        }
    }

</script>
<script>
    agregar_boton_ayuda('PRIVINCIASSUBRECEPTOR');
</script>