
<!-- Pre Page Content -->
<div id="pre-page-content">
    <h1>
        <i class="fa-user-md themed-color"></i> Registros de Atencion en Unidad de Salud<br>
        <small>Todos los registros de atencion en salud</small>
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
            <a href="#">Formularios</a> <span class="divider"><i class="icon-angle-right"></i></span>
        </li>
        <li class="active"><a href="#">Registros atencion salud</a></li>
    </ul>
    <!-- END Breadcrumb -->



    <?php if (!$tieneRestricciones): ?>            
        <?php $this->mostrar('formulariosGestion/formSubreceptorPeriodo', $this->datos, 'gestion'); ?>
    <?php endif; ?>



    <div class="row-fluid botones_arriba " >
        <div class=" span4 btn-group text-left">
            <a href="javascript:abrir_form_nuevo_registro_atencion_salud();" data-toggle="tooltip" title="Agregar NUEVO Registro de ATENCION EN SALUD para el periodo activo." class="btn btn-lg btn-info"><i class="icon-plus"></i> Nuevo</a>						
        </div>
        <span class="span4 text-center"><i class="icon-bolt"></i> <span id="registro-seleccionado">clic sobre un registro</span> </span>
        <div class=" span4 btn-group text-right">
            <a href="javascript:abrir_ver_datos_registro_atencion();" data-toggle="tooltip" title="ver los datos registrados de la Atencion en Unidad de Salud seleccinada " class="btn btn-lg btn-info"><i class="icon-zoom-in"></i> Ver</a>
            <a href="javascript:mostrar_formulario_editar_atencion_salud()" data-toggle="tooltip" title="editar Registro de Atencion en Salud seleccionado" class="btn btn-lg btn-warning"><i class="icon-pencil"></i> Editar</a>
            <a href="javascript:confimar_eliminar_atencion_salud()" data-toggle="tooltip" title="Borrar el Registro de Atencion en Salud seleccionado" class="btn btn-lg btn-danger"><i class="icon-remove"></i> Eliminar</a>
        </div>
    </div>

    <?php $this->mostrar("registro_atencion_salud/tablaRegistrosAtencionSalud", $this->datos); ?>


</div>



<script>
    $(document).ready(function() {
        $('#form-control-subreceptor-periodo').submit(function(e) {
            if (estaVacio($('#subreceptor-form-control').val())) {
                alert('Seleccione un Subreceptor.');
                return false;
            }
            abrir_listado_registro_atencion_salud($(this).serialize());
        });
        $('#tblRegistroAtencionSalud tbody tr').dblclick(function(e) {
            $(this).addClass('row_selected');
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
            mostrar_formulario_editar_atencion_salud();
        });

        $('#tblRegistroAtencionSalud tbody tr').on('click', function(e) {
            $('#registro-seleccionado').html($(this).attr('data-nombre'));
        });
    });
    function mostrar_formulario_editar_atencion_salud() {
        var tabla = $('#tblRegistroAtencionSalud').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            mostrar_contenidos(
                    'monitores', 'registroAtencionSalud', 'editar_form_registro_atencion_salud', 'id_atencion_salud=' + idFila
                    );
        } else {
            alert('Seleccione un registro');
        }

    }

    function confimar_eliminar_atencion_salud() {
        var tabla = $('#tblRegistroAtencionSalud').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            confirm('¿seguro que desea eliminar este registro de <strong>Atencion en Unidad de Salud</strong>?', 'eliminar_atencion_salud()');
        } else {
            alert('Seleccione un registro');
        }
    }

    function eliminar_atencion_salud() {
        var tabla = $('#tblRegistroAtencionSalud').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            ejecutarAccionJson(
                    'monitores', 'registroAtencionSalud', 'eliminar_registro_atencion_salud', 'id_atencion_salud=' + idFila,
                    'mostrar_resultado_guardar( data, abrir_listado_registro_atencion_salud(), "" );'
                    );
        } else {
            alert('Seleccione un registro');
        }

    }

    function abrir_ver_datos_registro_atencion() {
        var tabla = $('#tblRegistroAtencionSalud').dataTable();
        var idFila = filaId(tabla);
        if (idFila != null) {
            mostrar_datos_registro_atencion(idFila)
        } else {
            alert('Seleccione un registro');
        }
    }

</script>


