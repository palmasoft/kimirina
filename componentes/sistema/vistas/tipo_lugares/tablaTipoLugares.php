<?php ?>

<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="icon-compass themed-color"></i> Tipos de Lugares de Intervención<br>
        <small>Listado con todos los tipos de lugares donde se realiza una intervención, alcance, abordaje, contacto,...</small>
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
        <li class="active"><a href="#">Tipos de Lugares de Intervención</a></li>
    </ul>
    <!-- END Breadcrumb -->
    <div class=" row-fluid botones_arriba" >
        <div class=" span2 btn-group text-left">	
            <a href="javascript:abrir_formulario_tipo_lugares();" data-toggle="tooltip" title="Agregar nuevo Formulario al Registro" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>
        </div>
        <div class="span6 text-center">
            <i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span>
        </div>
        <div class=" span4 btn-group text-right">                
            <a href="javascript:mostrar_formulario_editar_tipo_lugares()" data-toggle="tooltip" title="Editar Formulario" class="btn btn-lg btn-warning"><i class="icon-pencil"></i>Editar</a>
            <a href="javascript:confirmar_eliminar_tipo_lugar()" data-toggle="tooltip" title="Borrar Formulario" class="btn btn-lg btn-danger"><i class="icon-remove"></i>Eliminar</a>
        </div>
    </div>

    <div class="block-section">
        <table id="tipos_de_lugares-datatables" class="table table-bordered table-hover dataTables">
            <thead>
            <th>Codigo</th>
            <th>Nombre</th>
            <th class="hidden-xs hidden-sm">Observaciones</th>
            </thead>
            <tbody>            
                <?php foreach ($TiposLugares as $tipoLugar) { ?>
                    <tr fila-id="<?php echo $tipoLugar->ID_TIPOLUGAR ?>" data-titulo="<?php echo ($tipoLugar->NOMBRE_TIPOLUGAR) ?>">
                        <td><?php echo ($tipoLugar->CODIGO_TIPOLUGAR) ?></td>
                        <td class="text-center"><?php echo ($tipoLugar->NOMBRE_TIPOLUGAR) ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo ($tipoLugar->OBSERVACIONES_TIPOLUGAR) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>   
    </div>   

</div>



<script>
    $(document).ready(function() {
        $('#tipos_de_lugares-datatables tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            var tabla = $('#tipos_de_lugares-datatables').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
            mostrar_formulario_editar_tipo_lugares();
        });

        $('#tipos_de_lugares-datatables tbody tr').live('click', function(e) {
            var tabla = $('#tipos_de_lugares-datatables').dataTable();
            $('#registro-seleccionado').html(filaSeleccionada(tabla, 'data-titulo'));
        });
    });



    function mostrar_formulario_editar_tipo_lugares() {
        var tabla = $('#tipos_de_lugares-datatables').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'sistema', 'tipoLugares', 'editar_form_tipo_lugares', 'id_tipolugar=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }

    }


    function confirmar_eliminar_tipo_lugar() {
        var tabla = $('#tipos_de_lugares-datatables').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            var tabla = $('#tipos_de_lugares-datatables').dataTable();
            var nameTipo = filaSeleccionada(tabla, 'data-titulo');
            confirm('¿Seguro que desea eliminar el tipo de lugar de intervencion <strong>' + nameTipo + '</strong> de este listado?', 'eliminar_tipo_lugar();' );
        } else {
            alert('Seleccione un registro');
        }

    }


    function eliminar_tipo_lugar() {
        var tabla = $('#tipos_de_lugares-datatables').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            ejecutarAccionJson(
                    'sistema', 'tipoLugares', 'eliminar_tipo_lugar', 'id_tipolugar=' + idFila,
                    ' mostrar_resultado_guardar( data, "abrir_tipo_lugares();", "" );'
                    );
        } else {
            alert('Seleccione un registro');
        }

    }
</script>
<script>
    agregar_boton_ayuda('LISTATIPOLUGARES');
</script>