
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="glyphicon-cargo themed-color"></i> Insumos<br>
        <small>Listado de insumos registrados</small>
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
        <li class="active"><a href="#">Insumos</a></li>
    </ul>
    <!-- END Breadcrumb -->
    <div class=" row-fluid botones_arriba" >
        <div class=" span2 btn-group text-left">	
            <a href="javascript:abrir_formulario_insumos();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span6 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_editar_insumo()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:confirmar_eliminar_insumo()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
    </div>

    <!--	<div class="block block-themed" >  
            <div class="block-title" >
                <h4></h4>
            </div>-->

    <!--<div class="block-content">--> 


    <!-- With Stripes Section -->
    <div class="block-section">

        <table id="insumos-tabla" class="table table-striped dataTables">
            <thead>
                <tr>
                    <th class="text-center">Nombre Insumo</th>
                    <th class="text-center">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($Insumos as $insumo) {
                    echo '
                                <tr fila-id="' . $insumo->ID_INSUMO . '" data-titulo="' . ($insumo->NOMBRE_INSUMO) . '">
                                    <td><h5>' . ($insumo->NOMBRE_INSUMO) . '</h5></td>
                                    <td class="hidden-phone">' . ($insumo->OBSERVACIONES) . '</td>                            
                                </tr>
                            ';
                }
                ?>

            </tbody>
        </table>

    </div>
    <!--</div>-->                   
</div>     
</div>

<script>
    $(document).ready(function() {
        $('#insumos-tabla tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            var tabla = $('#insumos-tabla').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
            mostrar_formulario_editar_insumo();
        });

        $('#insumos-tabla tbody tr').live('click', function(e) {
            var tabla = $('#insumos-tabla').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
        });
    });

    function mostrar_formulario_editar_insumo() {
        var tabla = $('#insumos-tabla').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'sistema', 'insumos', 'editar_form_insumo', 'id_insumo=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }

    }

    function confirmar_eliminar_insumo() {
        var tabla = $('#insumos-tabla').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            var tabla = $('#insumos-tabla').dataTable();
            var nameTipo = filaSeleccionada(tabla, 'data-titulo');
            confirm('¿Seguro que desea eliminar el insumo <strong>'+nameTipo+'<strong> ?','eliminar_insumo();')
        } else {
            alert('Seleccione un registro');
        }

    }
    function eliminar_insumo() {
        var tabla = $('#insumos-tabla ').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'sistema', 'insumos', 'eliminar_insumo', 'id_insumo=' + idFila,
                    ' mostrar_resultado_guardar( data, "abrir_tabla_insumos();", "" );'
                    );
        } else {
            alert('Seleccione un registro');
        }

    }

</script>
<script>
    agregar_boton_ayuda('LISTAINSUMOSSISTEMA');
</script>