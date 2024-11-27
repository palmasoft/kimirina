<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="fa-coffee  themed-color"></i> Lugares de Consejería a PVVS<br>
        <small>Listado de Lugares Consejería</small>
    </h1>
</div>
<!-- END Pre Page Content -->



<div id="page-content">

    <ul class="breadcrumb breadcrumb-top" data-spy="affix" data-offset-top="205">
        <li>
            <a href="./"><i class="glyphicon-display"></i></a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li>
            <a href="#">Configuración</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Lugares de Consejería</a></li>
    </ul>

    <div class="row-fluid"  >
        <div class="span2 btn-group text-left">
            <a href="javascript:abrir_form_nuevo_lugar_consejeria();" data-toggle="tooltip" title="Agregar nuevo lugar para consejeria" class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
        </div>
        <div class="span6 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </div>
        <div class="span4 btn-group text-right">
            <a href="javascript:mostrar_formulario_editar_consejeria();" data-toggle="tooltip" title="Editar el lugar de consejeria seleccionado" class="btn btn-lg btn-warning"><i class="icon-pencil"></i> Editar</a>
            <a href="javascript:confirmar_eliminar_esquema_consejeria()" data-toggle="tooltip" title="Borrar el lugar de consejeria seleccionado" class="btn btn-lg btn-danger"><i class="icon-remove"></i> Eliminar</a>
        </div>
    </div>

    
    <div class="block-section">
        <table id="tblConsejeria" class="table table-striped dataTables" >
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lugaresConsejeria as $consejeria) : ?>                
                    <tr fila-id="<?php echo ($consejeria->ID_LUGAR_CONSEJERIA) ?>" data-nombre="<?php echo ($consejeria->NOMBRE_LUGAR_CONSEJERIA) ?>">
                        <td><?php echo ($consejeria->CODIGO_LUGAR_CONSEJERIA) ?></td>
                        <td><?php echo ($consejeria->NOMBRE_LUGAR_CONSEJERIA) ?></td>
                        <td><?php echo ($consejeria->OBSERVACIONES_LUGAR_CONSEJERIA) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>

<script>
    $(document).ready(function() {
        $('#tblConsejeria tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
            mostrar_formulario_editar_consejeria();
        });

        $('#tblConsejeria tbody tr').live('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
    });

    function mostrar_formulario_editar_consejeria() {
        var tabla = $('#tblConsejeria').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            mostrar_contenidos(
                    'sistema', 'lugaresConsejerias', 'editar_form_lugares_consejeria', 'id_consejeria=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }

    }


    function confirmar_eliminar_esquema_consejeria() {
        var tabla = $('#tblConsejeria').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            var tabla = $('#tblConsejeria').dataTable();
            var nameTipo = filaSeleccionada(tabla, 'data-nombre');
            confirm('¿Seguro que desea eliminar el lugar de consejeria <strong>' + nameTipo + '</strong>?', 'eliminar_esquema_consejeria();')
        } else {
            alert('Seleccione un registro');
        }

    }


    function eliminar_esquema_consejeria() {
        var tabla = $('#tblConsejeria').dataTable();
        var idFila = filaId(tabla);
        //alert(idFila);
        if (idFila != null) {
            ejecutarAccionJson(
                    'sistema', 'lugaresConsejerias', 'eliminar_lugar_consejeria', 'id_consejeria=' + idFila,
                    ' mostrar_resultado_guardar( data, "abrir_listado_lugares_consejeria();", "" );'
                    );
        } else {
            alert('Seleccione un registro');
        }

    }

</script>
<script>
    agregar_boton_ayuda('LISTALUGARESCONSEJERI');
</script>