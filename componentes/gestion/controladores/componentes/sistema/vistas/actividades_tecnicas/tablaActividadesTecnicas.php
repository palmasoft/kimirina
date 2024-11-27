
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="icon-suitcase themed-color"></i>Listado de Actividades Tecnicas<br>
        <small>Todas las Actividades Tecnicas</small>
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
            <a href="#">Actividades Tecnicas</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Listado</a></li>
    </ul>
    <!-- END Breadcrumb -->
    
    <div class=" row-fluid botones_arriba" >
        <div class=" span4 btn-group text-left">	
            <a href="javascript:abrir_formulario_actividades_tecnicas();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span4 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_editar_actividad_tecnica()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:eliminar_actividades_tecnicas()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
    </div>
<!--
    <div class="block block-themed" >  
        <div class="block-title" >
            <h4></h4>
        </div>-->

            <!-- With Stripes Section -->
            <div class="block-section">
                <table id="actividades-tecnicas-tabla" class="table table-bordered table-hover dataTables">
                    <thead>
                        <tr>
                            <th class="text-center">Actividad</th>
                            <th class="text-center">Instrucciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($actividadesTecnicas as $actTecnica) {
                            echo '
                                <tr fila-id="' . $actTecnica->ID_ACTIVIDAD . '" data-titulo="' . ($actTecnica->NOMBRE_ACTIVIDAD) . '" >
                                    <td>' . ($actTecnica->NOMBRE_ACTIVIDAD) . '</td>
                                    <td class="hidden-phone">' . ($actTecnica->INSTRUCCIONES_ACTIVIDAD) . '</td>                            
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
        $('#actividades-tecnicas-tabla tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            var tabla = $('#actividades-tecnicas-tabla').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
            mostrar_formulario_editar_actividad_tecnica();
        });

        $('#actividades-tecnicas-tabla tbody tr').live('click', function(e) {
            var tabla = $('#actividades-tecnicas-tabla').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
        });
    });

    function mostrar_formulario_editar_actividad_tecnica() {
        var tabla = $('#actividades-tecnicas-tabla').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'sistema', 'actividadesTecnicas', 'editar_form_actividad_tecnica', 'id_actividad=' + idFila
                    );
        } else {

        }

    }
    
    

    function eliminar_actividades_tecnicas() {
        var tabla = $('#actividades-tecnicas-tabla').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'sistema', 'actividadesTecnicas', 'eliminar_actividad', 'id_actividad=' + idFila,
                    ' mostrar_resultado_guardar( data, "abrir_tabla_actividades_tecnicas();", "" );'
                    );
        } else {
            alert('Seleccione un registro');
        }

    }
    
    
</script>